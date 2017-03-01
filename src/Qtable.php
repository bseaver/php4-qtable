<?php
    class Qtable
    {
        private $qt_table_row;
        private $qt_columns_and_defaults;
        private $qt_quote_value_when_saving;
        private $qt_coerce_to_type;

        function __construct($name = '', $id = null)
        {
            $qt_columns_and_defaults = ['name' => '', 'id' => null];
            $qt_quote_value_when_saving = ['name'];
            $qt_coerce_to_type = ['id' => 'int'];

            $qt_table_row = $qt_columns_and_defaults;
            $this->set('name', $name);
            $this->set('id', $id);
        }

        function set($column, $value)
        {
            if (!is_null($value) && array_key_exists($column, $this->qt_coerce_to_type)) {
                switch ($qt_coerce_to_type[$column]) {
                    case 'int':
                        $value = (int) $value;
                        break;
                    case 'string':
                        $value = (int) $value;
                        break;
                }
            }
            $this->qt_table_row[$column] = $value;
        }

        function get($column) {
            return $this->qt_table_row[$column];
        }
        
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO categories (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_categories = $GLOBALS['DB']->query("SELECT * FROM categories;");
            $categories = array();
            foreach($returned_categories as $category) {
                $name = $category['name'];
                $id = $category['id'];
                $new_category = new Category($name, $id);
                array_push($categories, $new_category);
            }
            return $categories;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM categories;");
        }

        static function find($search_id)
        {
            $found_category = null;
            $categories = Category::getAll();
            foreach($categories as $category) {
                $category_id = $category->getId();
                if ($category_id == $search_id) {
                  $found_category = $category;
                }
            }
            return $found_category;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE categories SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM categories WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM categories_tasks WHERE category_id = {$this->getId()};");
        }

        function addTask($task)
        {
            $GLOBALS['DB']->exec("INSERT INTO categories_tasks (category_id, task_id) VALUES ({$this->getId()}, {$task->getId()});");
        }

        function getTasks()
        {
            $query = $GLOBALS['DB']->query("SELECT task_id FROM categories_tasks WHERE category_id = {$this->getId()};");
            // $task_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $tasks = array();
            // foreach($task_ids as $id) {
            foreach($query as $id) {
                $task_id = $id['task_id'];
                $result = $GLOBALS['DB']->query("SELECT * FROM tasks WHERE id = {$task_id};");
                $returned_task = $result->fetchAll(PDO::FETCH_ASSOC);

                $description = $returned_task[0]['description'];
                $id = $returned_task[0]['id'];
                $due_date = $returned_task[0]['due_date'];
                $done = $returned_task[0]['task_is_done'];
                $new_task = new Task($description, $id, $due_date, $done);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }
    }
?>
