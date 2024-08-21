<?php

class Model
{
    protected $table;
    protected $db;
    protected $conditions = [];
    protected $orderBy;
    protected $limit;
    protected $insertData = [];
    protected $offset;
    protected $select = ['*'];
    protected $currentPage = 1;
    protected $perPage = 10;
    protected $joins = [];


    public function __construct()
    {
        $this->db = (new DB())->connect();
    }

    public function select(array $columns)
    {
        $this->select = $columns;
        return $this;
    }

    public function paginate($perPage = null, $currentPage = null)
    {
        if (!is_null($perPage)) {
            $this->perPage = $perPage;
        }

        if (isset($_GET['page'])) {
            $this->currentPage = intval($_GET['page']);
        }

        if (!is_null($currentPage)) {
            $this->currentPage = $currentPage;
        }

        // Clone the model to create a separate instance for counting
        $countModel = clone $this;

        // Remove unnecessary select columns for count query
        $countModel->select(['*']);

        $totalItems = $countModel->count();
        $totalPages = ceil($totalItems / $this->perPage);

        $this->offset(($this->currentPage - 1) * $this->perPage)
            ->limit($this->perPage);

        $data = $this->getArray();

        return [
            'data' => $data,
            'totalItems' => $totalItems,
            'perPage' => $this->perPage,
            'currentPage' => $this->currentPage,
            'totalPages' => $totalPages,
        ];
    }


    public function join($table, $firstColumn, $operator, $secondColumn, $type = 'INNER')
    {
        $this->joins[] = [
            'table' => $table,
            'firstColumn' => $firstColumn,
            'operator' => $operator,
            'secondColumn' => $secondColumn,
            'type' => $type,
        ];
        return $this;
    }

    public function avg($column)
    {
        $query = "SELECT AVG(`{$column}`) as average FROM `{$this->table}`";

        if (!empty($this->conditions)) {
            $query .= " WHERE";
            foreach ($this->conditions as $index => $condition) {
                $value = $condition['operator'] === 'IN' ? $condition['value'] : "'" . $condition['value'] . "'";
                $query .= " {$condition['column']} {$condition['operator']} {$value}";

                if ($index !== count($this->conditions) - 1) {
                    $query .= " {$condition['logicalOperator']}";
                }
            }
        }

        $result = mysqli_query($this->db, $query);
        $row = mysqli_fetch_assoc($result);

        return $row['average'];
    }


    public function renderHtml($paginationData, $linkFormat = '?page=%d')
    {
        $html = '<nav>';
        $html .= '<ul class="rbt-pagination">';

        // Previous button
        $prevPage = isset($paginationData['currentPage']) ? $paginationData['currentPage'] - 1 : null;
        $prevUrl = ($prevPage > 0) ? sprintf($linkFormat, $prevPage) : '#';
        $html .= '<li><a href="' . $prevUrl . '" aria-label="Previous"><i class="feather-chevron-left"></i></a></li>';

        // Page links
        if (isset($paginationData['totalPages'])) {

            for ($i = 1; $i <= $paginationData['totalPages']; $i++) {
                $activeClass = (isset($paginationData['currentPage']) && $i == $paginationData['currentPage']) ? 'active' : '';
                $url = sprintf($linkFormat, $i);
                $html .= "<li class='{$activeClass}'><a href='{$url}'>{$i}</a></li>";
            }
        }

        // Next button
        $nextPage = isset($paginationData['currentPage']) ? $paginationData['currentPage'] + 1 : null;
        $nextUrl = (isset($nextPage) && $nextPage <= $paginationData['totalPages']) ? sprintf($linkFormat, $nextPage) : '#';
        $html .= '<li><a href="' . $nextUrl . '" aria-label="Next"><i class="feather-chevron-right"></i></a></li>';

        $html .= '</ul>';
        $html .= '</nav>';

        return $html;
    }

    public function renderAdminPaginate($paginationData, $linkFormat = '?page=%d')
    {
        $html = '<ul role="menubar" aria-disabled="false" aria-label="Pagination" class="pagination b-pagination">';

        // First button
        $html .= '<li role="presentation" class="page-item ' . ($paginationData['currentPage'] <= 1 ? 'disabled' : '') . '">';
        $html .= '<a role="menuitem" aria-label="Go to first page" aria-controls="my-table" class="page-link" href="' . sprintf($linkFormat, 1) . '"><i class="fas fa-angle-double-left"></i></a>';
        $html .= '</li>';

        // Previous button
        $prevPage = isset($paginationData['currentPage']) ? $paginationData['currentPage'] - 1 : null;
        $prevUrl = ($prevPage > 0) ? sprintf($linkFormat, $prevPage) : '#';
        $html .= '<li role="presentation" class="page-item ' . ($paginationData['currentPage'] <= 1 ? 'disabled' : '') . '">';
        $html .= '<a role="menuitem" aria-label="Go to previous page" aria-controls="my-table" class="page-link" href="' . $prevUrl . '"><i class="fas fa-angle-left"></i></a>';
        $html .= '</li>';

        // Page links
        if (isset($paginationData['totalPages'])) {
            for ($i = 1; $i <= $paginationData['totalPages']; $i++) {
                $activeClass = (isset($paginationData['currentPage']) && $i == $paginationData['currentPage']) ? 'active' : '';
                $url = sprintf($linkFormat, $i);
                $html .= "<li role=\"presentation\" class=\"page-item {$activeClass}\"><a role=\"menuitemradio\" href='{$url}' aria-controls=\"my-table\" aria-label=\"Go to page {$i}\" aria-checked=\"" . ($i == $paginationData['currentPage'] ? 'true' : 'false') . "\" aria-posinset=\"{$i}\" aria-setsize=\"250\" tabindex=\"" . ($i == $paginationData['currentPage'] ? '0' : '-1') . "\" class=\"page-link\">{$i}</a></li>";
            }
        }

        // Next button
        $nextPage = isset($paginationData['currentPage']) ? $paginationData['currentPage'] + 1 : null;
        $nextUrl = (isset($nextPage) && $nextPage <= $paginationData['totalPages']) ? sprintf($linkFormat, $nextPage) : '#';
        $html .= '<li role="presentation" class="page-item ' . ($paginationData['currentPage'] >= $paginationData['totalPages'] ? 'disabled' : '') . '">';
        $html .= '<a role="menuitem" type="button" tabindex="-1" aria-label="Go to next page" aria-controls="my-table" class="page-link" href="' . $nextUrl . '"><i class="fas fa-angle-right"></i></a>';
        $html .= '</li>';

        // Last button
        $html .= '<li role="presentation" class="page-item ' . ($paginationData['currentPage'] >= $paginationData['totalPages'] ? 'disabled' : '') . '">';
        $lastPage = $paginationData['totalPages'];
        $lastUrl = ($lastPage > 0) ? sprintf($linkFormat, $lastPage) : '#';
        $html .= '<a role="menuitem" type="button" tabindex="-1" aria-label="Go to last page" aria-controls="my-table" class="page-link" href="' . $lastUrl . '"><i class="fas fa-angle-double-right"></i></a>';
        $html .= '</li>';

        $html .= '</ul>';

        return $html;
    }


    public function where($column, $operator, $value)
    {
        $this->conditions[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'logicalOperator' => 'AND',
        ];
        return $this;
    }

    public function orWhere($column, $operator, $value)
    {
        $this->conditions[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'logicalOperator' => 'OR',
        ];
        return $this;
    }

    public function whereIn($column, array $values)
    {
        $formattedValues = implode(', ', array_map(function ($value) {
            return "'" . mysqli_real_escape_string($this->db, $value) . "'";
        }, $values));

        $this->conditions[] = [
            'column' => $column,
            'operator' => 'IN',
            'value' => "({$formattedValues})",
            'logicalOperator' => 'AND',
        ];

        return $this;
    }

    public function whereNotIn($column, array $values)
    {
        $formattedValues = implode(', ', array_map(function ($value) {
            return "'" . mysqli_real_escape_string($this->db, $value) . "'";
        }, $values));

        $this->conditions[] = [
            'column' => $column,
            'operator' => 'NOT IN',
            'value' => "({$formattedValues})",
            'logicalOperator' => 'AND',
        ];

        return $this;
    }

    public function latest($column = 'id', $direction = 'desc')
    {
        $this->orderBy($column, $direction);
        return $this;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->orderBy = [
            'column' => $column,
            'direction' => $direction,
        ];
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function get()
    {
        $selectColumns = implode(', ', $this->select);
        $query = "SELECT {$selectColumns} FROM `{$this->table}`";

        // Add join statements to the query
        foreach ($this->joins as $join) {
            $query .= " {$join['type']} JOIN `{$join['table']}` ON `{$this->table}`.`{$join['firstColumn']}` {$join['operator']}`{$join['table']}`.`{$join['secondColumn']}`";
        }

        if (!empty($this->conditions)) {
            $query .= " WHERE";
            foreach ($this->conditions as $index => $condition) {
                $value = $condition['operator'] === 'IN' || $condition['operator'] === 'NOT IN' ? $condition['value'] : '?';
                $query .= " {$condition['column']} {$condition['operator']} {$value}";

                if ($index !== count($this->conditions) - 1) {
                    $query .= " {$condition['logicalOperator']}";
                }
            }
        }

        if (!empty($this->orderBy)) {
            $query .= " ORDER BY {$this->orderBy['column']} {$this->orderBy['direction']}";
        }

        if (!is_null($this->limit)) {
            $query .= " LIMIT ?";
        }

        if (!is_null($this->offset)) {
            $query .= " OFFSET ?";
        }

        $stmt = mysqli_prepare($this->db, $query);

        if (!$stmt) {
            die('Error in SQL query: ' . mysqli_error($this->db));
        }

        // Bind values for conditions, limit, and offset
        $this->bindValues($stmt);

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_error($stmt)) {
            die('Error executing SQL statement: ' . mysqli_stmt_error($stmt));
        }

        return mysqli_stmt_get_result($stmt);
    }


    private function bindValues($stmt, $values = [])
    {
        if (!empty($this->conditions) || !is_null($this->limit) || !is_null($this->offset) || !empty($values)) {
            $types = '';
            $bindParams = [];

            if (!empty($values)) {
                foreach ($values as &$value) {
                    $types .= $this->getTypeChar($value);
                    $bindParams[] = &$value;
                }
            } else {
                foreach ($this->conditions as $condition) {
                    if ($condition['operator'] !== 'IN' && $condition['operator'] !== 'NOT IN') {
                        $types .= $this->getTypeChar($condition['value']);
                        $bindParams[] = &$condition['value'];
                    }
                }

                if (!is_null($this->limit)) {
                    $types .= 'i'; // 'i' for integer
                    $bindParams[] = &$this->limit;
                }

                if (!is_null($this->offset)) {
                    $types .= 'i'; // 'i' for integer
                    $bindParams[] = &$this->offset;
                }
            }

            if ($types !== '') {
                // Prepend the types to the beginning of $bindParams
                array_unshift($bindParams, $types);

                // Use ReflectionMethod to invoke bind_param with correct references
                $reflectionMethod = new ReflectionMethod('mysqli_stmt', 'bind_param');
                $reflectionMethod->invokeArgs($stmt, $bindParams);
            }
        }
    }



    private function getTypeChar($value)
    {
        if (is_int($value)) {
            return 'i'; // Integer
        } elseif (is_float($value)) {
            return 'd'; // Double
        } else {
            return 's'; // String
        }
    }


    public function insert(array $data)
    {
        $this->insertData = $data;

        if (!empty($this->insertData)) {
            $columns = implode(', ', array_keys($this->insertData));
            $values = implode(', ', array_fill(0, count($this->insertData), '?'));

            $query = "INSERT INTO `{$this->table}` ({$columns}) VALUES ({$values})";

            $stmt = mysqli_prepare($this->db, $query);

            // Bind values for insertion
            $this->bindValues($stmt, $this->insertData);

            return mysqli_stmt_execute($stmt);
        }

        return false;
    }


    public function first()
    {
        $this->limit(1);
        $result = $this->get();
        return mysqli_fetch_assoc($result);
    }

    public function getArray()
    {
        $result = $this->get();

        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function when($condition, $callback)
    {
        if ($condition) {
            $callback($this);
        }
        return $this;
    }

    public function update(array $data)
    {
        if (empty($this->conditions)) {
            throw new Exception("Update conditions not specified");
        }

        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "{$column} = '{$value}'";
        }

        $query = "UPDATE `{$this->table}` SET " . implode(', ', $set);

        if (!empty($this->conditions)) {
            $query .= " WHERE";
            foreach ($this->conditions as $index => $condition) {
                $value = $condition['operator'] === 'IN' ? $condition['value'] : "'" . $condition['value'] . "'";
                $query .= " {$condition['column']} {$condition['operator']} {$value}";

                if ($index !== count($this->conditions) - 1) {
                    $query .= " {$condition['logicalOperator']}";
                }
            }
        }

        return mysqli_query($this->db, $query);
    }

    public function delete()
    {
        if (empty($this->conditions)) {
            throw new Exception("Delete conditions not specified");
        }

        $query = "DELETE FROM `{$this->table}`";

        if (!empty($this->conditions)) {
            $query .= " WHERE";
            foreach ($this->conditions as $index => $condition) {
                $value = $condition['operator'] === 'IN' ? $condition['value'] : "'" . $condition['value'] . "'";
                $query .= " {$condition['column']} {$condition['operator']} {$value}";

                if ($index !== count($this->conditions) - 1) {
                    $query .= " {$condition['logicalOperator']}";
                }
            }
        }

        return mysqli_query($this->db, $query);
    }

    public function count()
    {
        // Clone the model to create a separate instance for counting
        $countModel = clone $this;

        // Remove unnecessary select columns for count query
        $countModel->select(['*']);

        $query = "SELECT COUNT(DISTINCT {$this->table}.id) as count FROM `{$this->table}`";

        // Add joins to the count query
        foreach ($countModel->joins as $join) {
            $query .= " {$join['type']} JOIN `{$join['table']}` ON `{$this->table}`.`{$join['firstColumn']}` {$join['operator']} `{$join['table']}`.`{$join['secondColumn']}`";
        }

        if (!empty($countModel->conditions)) {
            $query .= " WHERE";
            foreach ($countModel->conditions as $index => $condition) {
                $value = $condition['operator'] === 'IN' ? $condition['value'] : "'" . $condition['value'] . "'";
                $query .= " {$condition['column']} {$condition['operator']} {$value}";

                if ($index !== count($countModel->conditions) - 1) {
                    $query .= " {$condition['logicalOperator']}";
                }
            }
        }

        // Debug: Output the generated SQL query for count

        $result = mysqli_query($this->db, $query);
        $row = mysqli_fetch_assoc($result);

        return $row['count'];
    }



    public function sum($column)
    {
        $query = "SELECT SUM(`{$column}`) as sum FROM `{$this->table}`";

        if (!empty($this->conditions)) {
            $query .= " WHERE";
            foreach ($this->conditions as $index => $condition) {
                $value = $condition['operator'] === 'IN' ? $condition['value'] : "'" . $condition['value'] . "'";
                $query .= " {$condition['column']} {$condition['operator']} {$value}";

                if ($index !== count($this->conditions) - 1) {
                    $query .= " {$condition['logicalOperator']}";
                }
            }
        }

        $result = mysqli_query($this->db, $query);
        $row = mysqli_fetch_assoc($result);

        return $row['sum'];
    }

    public function whereToday($column)
    {
        $today = date('Y-m-d');
        $this->where($column, '>=', $today . ' 00:00:00')
            ->where($column, '<=', $today . ' 23:59:59');
        return $this;
    }
}
