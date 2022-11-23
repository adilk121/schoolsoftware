    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
        <ul>
           <li <?php if($page_name=='index'){ ?> class="submenu active" <?php }else{?> class="submenu"<?php }?>>
                
                 <li><a href="index.php"><i class="fas fa-users"></i> <span>Dashboard</span></a></li>
       </li>
              <?php
           if($_SESSION['user_role']=='T' || $_SESSION['user_role']=='G')
           {
    ?>  <li>
               <a href="students.php" ><i class="fas fa-user-graduate"></i> <span> Student List</span></a>
                  </li>
                  <li>
               <a href="students-score.php" ><i class="fas fa-star"></i> <span> Students Score</span></a>
                  </li>
                 
<?php }?>
              <?php
           if($_SESSION['user_role']=='P')
           {
    ?>
              <li <?php if($page_name=='students' || $page_name=='add-student' || $page_name=='edit-student'  ){ ?> class="submenu active" <?php }else{?> class="submenu"<?php }?>>
                <a href="#"
                  ><i class="fas fa-user-graduate"></i> <span> Students </span>
                  <span class="menu-arrow"></span
                ></a>
                <ul>
                  <li>
                    <a href="students.php" >Student List</a>
                  </li>
                  
                  <li><a href="add-student.php">Student Add</a></li>
                  
                </ul>
              </li>


              
              <li <?php if($page_name=='teachers' || $page_name=='add-teacher' || $page_name=='edit-teacher'  ){ ?> class="submenu active" <?php }else{?> class="submenu"<?php }?>>
                <a href="#"
                  ><i class="fas fa-chalkboard-teacher"></i>
                  <span> Teachers</span> <span class="menu-arrow"></span
                ></a>
                <ul>
                  <li><a href="teachers.php">Teacher List</a></li>
                  <li><a href="add-teacher.php">Teacher Add</a></li>
                </ul>
              </li>
              <li   <?php if($page_name=='guardian' || $page_name=='add-guardian' || $page_name=='edit-guardian'  ){ ?> class="submenu active" <?php }else{?> class="submenu"<?php }?>>
                <a href="#"
                  ><i class="fas fa-building"></i> <span> Guardian</span>
                  <span class="menu-arrow"></span
                ></a>
                <ul>
                  <li><a href="guardian.php">Guardian List</a></li>
                  <li><a href="add-guardian.php">Add Guardian</a></li>
                </ul>
              </li>
             
              <li <?php if($page_name=='class' || $page_name=='add-class'|| $page_name=='edit-class' || $page_name=='edit-subject' || $page_name=='subjects'  || $page_name=='add-subject' ){ ?> class="submenu active" <?php }else{?> class="submenu"<?php }?>>
                <a href="#"
                  ><i class="fas fa-book-reader"></i> <span> Classes & Subjects</span>
                  <span class="menu-arrow"></span
                ></a>
                <ul>
                  <li><a href="class.php">Class List</a></li>
                </ul>
              </li>
              <?php }?>
              
              <?php
           if($_SESSION['user_role']=='S')
           {
    
           ?>
             <li class="submenu">
                
                 <li><a href="my-profile.php"><i class="fas fa-user-graduate"></i> <span>My Profile</span></a></li>
                  
                
              </li>
              <?php } ?>
            </ul>
          </div>
    
        </div>
      </div>
