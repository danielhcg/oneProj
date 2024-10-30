{source}
This code is the same code as file 5. Limit is a list box which makes it to be a <br>
variable now. We still need to do the following:<br>
- The program should work against any object and not just the Ticket table <br>
- Can we make the list box to be a radio button or make it to print horizontally? <br>
- Need to provide "checkboxes" as we have in the file 0-OOP <br>
- The where clause should be dynamic to pick any attribute and combine them into one <br><br>

<hr>

<?php
session_start();
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Menu;

//===============================================================================

    class myObject
    {

        public $limit = 10; public $offset; public $db; public $query; 
        public $columns; public $columnData; public $total; public $Space; public $columnHeaders;
        public $select ="*"; public $from = "Ticket";

//===============================================================================


public function checkboxData (){

    // Get a database connection
    $db = Factory::getDbo();
    
    // Get the database schema
    $columns = $db->getTableColumns("Ticket");
    $columns += $db->getTableColumns("Persons");
    // Extract the column names
    $this->columnHeaders = array_keys($columns);
}


//-------------------------------------------------------------------------------

         public function NumOfRowsPrintedAtATime()
         {
              ?>
               <!DOCTYPE html>
               <html lang="en">
               <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

               <head>
                    <style>
                         hr.custom { width: 5.1in; color: black; background-color: blue; height: 110px; border: none; }
                         input[type="submit"] { background-color: RED; color: white; border: none; padding: 2px 10px; cursor: pointer; border-radius: 4px; }
                    </style>
                    <body>
                         <form method="post"><label for="cars">Select The number of rows you like to see at a time? :</label>
                              <select name="limit" id="limit">
                                   <option value="5"> 5 </option>    <option value="10">10</option>    <option value="15">15</option>   
                                   <option value="20">20</option>    <option value="25">25</option>
                              </select>
                                <div>
                                <?php
                                    foreach($this->columnHeaders as &$columnName)
                                {
                                    echo "\n". "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". "<input id=\"" . $columnName . "\" name=\"" . 
                                    $columnName . "\" type=\"checkbox\" value=\"" .
                                    $columnName . "\" /><label for=\"" . $columnName . "\">&nbsp" . $columnName . "</label>";
                                }

                                $this->Space =  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                echo "<hr>";
                                ?>
                                </div>
                              <input type="submit" value="Submit">
                          </form>
                          </body>
                          <hr class="custom">
               </head>
               </html> 

               <?php
         }  


//===============================================================================

        public function ChangeMenu()
        {
              $app = Factory::getApplication();
              $db = Factory::getDbo();

              $activeMenu = $app->getMenu()->getActive();
              if ($activeMenu) 
                    $menuItemId = $activeMenu->id;
              else
              {
                    echo "No active menu item found.";
                    return;
              }

              $menuTable = new Menu($db);
              $menuTable->load($menuItemId);
              $menuTable->home = 1;

              if (!$menuTable->store())
              {
                     echo "Failed to save changes to the database.";
                     return;
              }

         }

//===============================================================================
         public function openDB()
         {
             $limit = $this->limit; $offset = $this->offset; $db = $this->db; 
             JLoader::register('Table', JPATH_LIBRARIES . '/joomla/database/table.php');

            $input = Factory::getApplication()->input;
            $limit = $input->getInt('limit', 5);
            $offset = $input->getInt('start', 0);
            $db = JFactory::getDbo();
            $this->limit = $limit; $this->offset = $offset; $this->db=$db;
         }

  
//===============================================================================
        public function getQuery($where)
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $query = $this->query; $columns = $this->columns; $limit = $this->limit; 
                $offset = $this->offset; $db = $this->db; $start = $this->start;
                $query = $db->getQuery(true);
                $query->from($db->quoteName( "Ticket"));
                if(isset($_POST["FName"]) || isset($_POST["LName"]) || isset($_POST["Age"]) || isset($_POST["TicketNum"]) ){
                    $query->join('INNER','Persons ON Persons.TicketNum = Ticket.TicketID');   
                } 
                $arraySelect = [];

                $start = 0;
                $offset = 0;

                foreach($this->columnHeaders as $headers){
                    if (isset($_POST[$headers] ) ){
                        array_push($arraySelect, $headers);
                    }
                }  
                
                $query->select($db->quoteName($arraySelect));
       

                $expression = $where;
                $parts = explode(' ', $expression, 3); // Assuming column, operator, and value
                $quotedColumn = $db->quoteName($parts[0]);
                $quotedExpression = $quotedColumn . ' ' . $parts[1] . ' ' . $parts[2];
                $query->where($quotedExpression);
                $query->setLimit($limit, $offset);
               
                $db->setQuery($query);
                $columns = $db->loadObjectList();
                $this->query = $query; $this->columns = $columns; $this->limit = $limit; 
                $this->offset = $offset; $this->db = $db; $this->$start = $start;
            }elseif(!(empty($_SESSION['name']))){
                $query = $this->query; $columns = $this->columns; $limit = $this->limit; 
                $offset = $this->offset; $db = $this->db;
                $data = $_SESSION['name'];
                $arraySelect = [];

                $query = $db->getQuery(true);


                foreach($this->columnHeaders as $headers){
                    if (isset($data[$headers] ) ){
                        array_push($arraySelect, $headers);
                    }
                }  

                $query->select($db->quoteName(array("*")));

    
                $query->from($db->quoteName( "Ticket"));
                if(isset($data["FName"]) || isset($data["LName"]) || isset($data["Age"]) || isset($data["TicketNum"]) ){
                    $query->join('INNER','Persons ON Persons.TicketNum = Ticket.TicketID');   
                } 

                $expression = $where;
                $parts = explode(' ', $expression, 3); // Assuming column, operator, and value
                $quotedColumn = $db->quoteName($parts[0]);
                $quotedExpression = $quotedColumn . ' ' . $parts[1] . ' ' . $parts[2];
                $query->where($quotedExpression);
                $query->setLimit($limit, $offset);
               
                $db->setQuery($query);
                $columns = $db->loadObjectList();
                $this->query = $query; $this->columns = $columns; $this->limit = $limit; 
                $this->offset = $offset; $this->db = $db;
            }else{
                $query = $this->query; $columns = $this->columns; $limit = $this->limit; 
                $offset = $this->offset; $db = $this->db;

                $query = $db->getQuery(true);

                $query->select($db->quoteName(array($this->select)));  
    
                $query->from($db->quoteName( "Ticket"));    

                $expression = $where;
                $parts = explode(' ', $expression, 3); // Assuming column, operator, and value
                $quotedColumn = $db->quoteName($parts[0]);
                $quotedExpression = $quotedColumn . ' ' . $parts[1] . ' ' . $parts[2];
                $query->where($quotedExpression);
                $query->setLimit($limit, $offset);
               
                $db->setQuery($query);
                $columns = $db->loadObjectList();
                $this->query = $query; $this->columns = $columns; $this->limit = $limit; 
                $this->offset = $offset; $this->db = $db;
            }
       }


 //===============================================================================

       public function getTheNumberOfRows()
       {     
           $db = $this->db; $columnsData = $this->columnsData; 
           $columns = $this->columns; $total = $this->total; $query = $this->query;
           
           $queryCount = clone $query;
           $queryCount->clear('select')->clear('order')->clear('limit');
           $queryCount->select('COUNT(*)');
           $db->setQuery($queryCount);
           $total = $db->loadResult();
           $columnsData = array('columns' => $columns, 'total' => $total);

           $columns = $columnsData['columns'];
           $total = $columnsData['total'];


           $this->db = $db; $this->columnsData = $columnsData; 
           $this->columns = $columns; $this->total = $total; $this->query = $query;
       }

//===============================================================================
       public function printHeader()
       {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $_SESSION['name'] = $_POST;
                $Space =  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                echo "<table>";
                echo "<tr style=\"background-color:Blue;color:White\">";
                echo"<th>";
                foreach($this->columnHeaders as $headers){
                        if (isset($_POST[$headers] ) ){
                                echo "<td>" . $headers . $Space . "</td>";
                        }
                }  
                echo "</th>" . "</tr>";

                $this->Space = $Space;
            }elseif(!(empty($_SESSION['name']))){
                $data = $_SESSION['name'];
                $limit = $this->limit; 
                $limit = $data["limit"];
                $Space =  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                echo "<table>";
                echo "<tr style=\"background-color:Blue;color:White\">";
                echo"<th>";
                foreach($this->columnHeaders as $headers){
                        if (isset($data[$headers] ) ){
                                echo "<td>" . $headers . $Space . "</td>";
                        }
                }  
                echo "</th>" . "</tr>";

                $this->Space = $Space; $this->limit = $limit;

            }else{
                $Space =  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                echo "<table>";
                echo "<tr style=\"background-color:Blue;color:White\">";
                echo"<th>";
                foreach($this->columnHeaders as $headers){
                    echo "<td>" . $headers . $Space . "</td>";
                }  
                echo "</th>" . "</tr>";

                $this->Space = $Space;
            }
        }
//===============================================================================
      public function printData()
      {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $columns = $this->columns;
                $Space = $this->Space;
                foreach ($columns as $column){
                    echo "<tr>" . "<th>";
                    foreach ($this->columnHeaders as $headers){
                        if(isset($_POST[$headers])){
                            echo "<td>" . $column->$headers . $Space . "</td>";
                        }
                    }
                    echo "</th>" . "</tr>";
                }
                echo "</table>";
            }elseif(!(empty($_SESSION['name']))){
                $data = $_SESSION['name'];
                $columns = $this->columns;
                $Space = $this->Space;
                foreach ($columns as $column){
                    echo "<tr>" . "<th>";
                    foreach ($this->columnHeaders as $headers){
                        if (isset($data[$headers] ) ){
                            echo "<td>" . $column->$headers . $Space . "</td>";
                        }
                    }
                    echo "</th>" . "</tr>";
                }
                echo "</table>";
            }else{
                $columns = $this->columns;
                $Space = $this->Space;
                foreach ($columns as $column){
                    echo "<tr>" . "<th>";
                    foreach ($this->columnHeaders as $headers){
                        echo "<td>" . $column->$headers . $Space . "</td>";
                    }
                    echo "</th>" . "</tr>";
                }
                echo "</table>";
            }
       }


//===============================================================================
       public function DoPagination()  
       {
            $total = $this->total;
            $limit = $this->limit;
            $offset = $this->offset;
            $totalPages = ceil($total / $limit);
            $currentUrl = $_SERVER['PHP_SELF'];
            $paginationLinks = '';
            //https://cs643.cs.csusm.edu/andre150/index.php?start=0&limit=5
            //https://cs643.cs.csusm.edu/andre150/index.php?start=0&limit=15
            if ($totalPages > 1) {
                $currentPage = floor($offset / $limit) + 1;
                $paginationLinks .= '<ul class="flex space-x-2 justify-left my-4">';

                // Previous button
                if ($currentPage > 1) {
                    $paginationLinks .= '<li><a href="' . $currentUrl . '?start=' . (($currentPage - 2) * $limit) . '&limit=' . $limit . '" class="py-2 px-2 rounded-md border border-red-300 hover:bg-red-100">&laquo; Previous</a></li>';
                }

                // First page
                if ($currentPage > 3) {
                    $paginationLinks .= '<li><a href="' . $currentUrl . '?start=0&limit=' . $limit . '" class="py-2 px-2 rounded-md border border-red-300 hover:bg-red-100">1</a></li>';
                    if ($currentPage > 4) {
                        $paginationLinks .= '<li class="py-2 px-2">...</li>';
                    }
                }

                // Page numbers
                for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++) {
                    $activeClass = $currentPage == $i ? 'bg-red-500 text-white' : '';
                    $paginationLinks .= '<li><a href="' . $currentUrl . '?start=' . (($i - 1) * $limit) . '&limit=' . $limit . '" class="py-2 px-2 rounded-md border border-red-300 hover:bg-red-100 ' . $activeClass . '">' . $i . '</a></li>';
                }

                // Last page
                if ($currentPage < $totalPages - 2) {
                    if ($currentPage < $totalPages - 3) {
                        $paginationLinks .= '<li class="py-2 px-2">...</li>';
                    }
                    $paginationLinks .= '<li><a href="' . $currentUrl . '?start=' . (($totalPages - 1) * $limit) . '&limit=' . $limit . '" class="py-2 px-2 rounded-md border border-red-300 hover:bg-red-100">' . $totalPages . '</a></li>';
                }

                // Next button
                if ($currentPage < $totalPages) {
                    $paginationLinks .= '<li><a href="' . $currentUrl . '?start=' . ($currentPage * $limit) . '&limit=' . $limit . '" class="py-2 px-2 rounded-md border border-red-300 hover:bg-red-100">Next &raquo;</a></li>';
                }

                $paginationLinks .= '</ul>';
            }

            echo $paginationLinks;
       }

        

//===============================================================================
      public function __Construct($where)
       {
            $this->checkboxData();
            
            $this->NumOfRowsPrintedAtATime();
            $this->ChangeMenu();
            $this->openDB();
            $this->getQuery($where);
            $this->getTheNumberOfRows();
            $this->printHeader();
            $this->printData();
            $this->DoPagination();

       }
//===============================================================================
    } // end of the class


//***********************************************************************************************************************
//***********************************************************************************************************************

$T1 = new myObject ("TicketID >= 25");

?>
</body>
</html>
{/source}


