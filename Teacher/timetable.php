<?php 
		include('Panel/header.php');

		include('Panel/navbar.php');

		include('Panel/topbar.php');

?>
		 <!-- Page Heading -->
		            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Lecture Time-table</h1>
                 <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i
                class="fas fa-download fa-sm text-white-50"></i>Lecture Time-table</a>
              </div>  

<!-- time table -->

<table border="5" cellspacing="0" align="center"> 
        <!--<caption>Timetable</caption>-->
        <tr> 
            <td align="center" height="50" 
                width="100"><br> 
                <b>Day/Period</b></br> 
            </td> 
            <td align="center" height="50" 
                width="100"> 
                <b>I<br>9:30-10:20</b> 
            </td> 
            <td align="center" height="50" 
                width="100"> 
                <b>II<br>10:20-11:10</b> 
            </td> 
            <td align="center" height="50" 
                width="100"> 
                <b>III<br>11:10-12:00</b> 
            </td> 
            <td align="center" height="50" 
                width="100"> 
                <b>12:00-12:40</b> 
            </td> 
            <td align="center" height="50" 
                width="100"> 
                <b>IV<br>12:40-1:30</b> 
            </td> 
            <td align="center" height="50" 
                width="100"> 
                <b>V<br>1:30-2:20</b> 
            </td> 
            <td align="center" height="50" 
                width="100"> 
                <b>VI<br>2:20-3:10</b> 
            </td> 
            <td align="center" height="50" 
                width="100"> 
                <b>VII<br>3:10-4:00</b> 
            </td> 
        </tr> 
        <tr> 
            <td align="center" height="50"> 
                <b>Monday</b></td> 
            <td align="center" height="50">Eng</td> 
            <td align="center" height="50">Mat</td> 
            <td align="center" height="50">Che</td> 
            <td rowspan="6" align="center" height="50"> 
                <h2>L<br>U<br>N<br>C<br>H</h2> 
            </td> 
            <td colspan="3" align="center" 
                height="50">LAB</td> 
            <td align="center" height="50">Phy</td> 
        </tr> 
        <tr> 
            <td align="center" height="50"> 
                <b>Tuesday</b> 
            </td> 
            <td colspan="3" align="center" 
                height="50">LAB 
            </td> 
            <td align="center" height="50">Eng</td> 
            <td align="center" height="50">Che</td> 
            <td align="center" height="50">Mat</td> 
            <td align="center" height="50">SPORTS</td> 
        </tr> 
        <tr> 
            <td align="center" height="50"> 
                <b>Wednesday</b> 
            </td> 
            <td align="center" height="50">Mat</td> 
            <td align="center" height="50">phy</td> 
            <td align="center" height="50">Eng</td> 
            <td align="center" height="50">Che</td> 
            <td colspan="3" align="center" 
                height="50">LIBRARY 
            </td> 
        </tr> 
        <tr> 
            <td align="center" height="50"> 
                <b>Thursday</b> 
            </td> 
            <td align="center" height="50">Phy</td> 
            <td align="center" height="50">Eng</td> 
            <td align="center" height="50">Che</td> 
            <td colspan="3" align="center" 
                height="50">LAB 
            </td> 
            <td align="center" height="50">Mat</td> 
        </tr> 
        <tr> 
            <td align="center" height="50"> 
                <b>Friday</b> 
            </td> 
            <td colspan="3" align="center" 
                height="50">LAB 
            </td> 
            <td align="center" height="50">Mat</td> 
            <td align="center" height="50">Che</td> 
            <td align="center" height="50">Eng</td> 
            <td align="center" height="50">Phy</td> 
        </tr> 
        <tr> 
            <td align="center" height="50"> 
                <b>Saturday</b> 
            </td> 
            <td align="center" height="50">Eng</td> 
            <td align="center" height="50">Che</td> 
            <td align="center" height="50">Mat</td> 
            <td colspan="3" align="center" 
                height="50">SEMINAR 
            </td> 
            <td align="center" height="50">SPORTS</td> 
        </tr> 
    </table> 

    
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Lecture Time-table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
  <div class="form-group">
    <label for="exampleFormControlFile1">Uplode Time Table</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
</form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-success="modal">Uplode</button>
      </div>
    </div>
  </div>
</div>
<?php
		include('Panel/script.php');

		include('Panel/footer.php');

?>