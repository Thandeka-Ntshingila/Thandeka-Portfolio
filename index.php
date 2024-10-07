<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=todo_list'; $username = 'root'; // default username for AMPPS $password
$password = 'mysql'; // default password for AMPPS 

try { 
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) { 
        echo 'Connection failed: '.$e->getMessage();
        exit;
    } 
     // Handle form submission 
     if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
         if (isset($_POST['description'])) { 
             $description = $_POST['description'];
             $stmt = $pdo->prepare("INSERT INTO tasks (description) VALUES (:description)"); 
             $stmt->execute(['description' => $description]); 
         } elseif (isset($_POST['completed'])) { 
             $id = $_POST['id'];
             $completed = $_POST['completed'] === 'on' ? 1 : 0;
             $stmt = $pdo->prepare("UPDATE tasks SET completed = :completed WHERE id = :id");
             $stmt->execute(['completed' => $completed, 'id' => $id]); 
           }
         } 
          // Fetch tasks 
          $stmt = $pdo->query("SELECT * FROM lists");
          $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC); 

?>
<!DOCTYPE html>
 <html> 
     <head> 
         <title>To-Do List</title> 
     </head> 
     <body> 
         <h1>To-Do List</h1>
         <form method="post"> 
             <label for="description">New Task:</label> 
             <input type="text" id="description" name="description" required> 
             <button type="submit">Add Task</button>
         </form> 
         <h2>Tasks</h2> 
         <table>
             <thead> 
                 <tr>
                     <th>Description</th> 
                     <th>Completed</th> 
                 </tr> 
             </thead>
             <tbody> 
                 <?php foreach ($tasks as $task): ?>
                 <tr> 
                     <td><?php echo htmlspecialchars($task['description']); ?></td> 
                     <td> 
                         <form method="post" style="display:inline;"> 
                             <input type="hidden" name="id" value="
                                 <?php echo $task['id']; ?>"> 
                             <input type="checkbox" name="completed" value="1" 
                                 <?php echo $task['completed'] ? 'checked' : ''; ?> 
                                    onchange="this.form.submit();"> 
                         </form> 
                     </td> 
                 </tr> 
                     <?php endforeach; ?> 
             </tbody> 
         </table> 
     </body> 
 </html>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

