<?php 
session_start();

if(isset($_POST['submitted'])) {

    $posF_checkbox = array('pFQB','pFRB','pFWR','pFTE','pFOL','pFDL','pFLB','pFS_CB','pFSpec');

    foreach($posF_checkbox as $check)  {

        if(is_array($_POST['positionFsel']) && in_array($check, $_POST['positionFsel'])) {
            $_SESSION[$check] = true;
        } else {
            $_SESSION[$check] = false;
        }
    }

    $teamF_checkbox = array('tFBUF','tFARZ','tFATL','tFBAL','tFCAR','tFCHI','tFCIN','tFCLE','tFDAL','tFDEN','tFDET','tFGB','tFHOU','tFIND','tFJAX','tFKC','tFMIA','tFMIN','tFNE','tFNO','tFNYG','tFNYJ','tFOAK','tFPHI','tFPIT','tFSD','tFSEA','tFSF','tFSTL','tFTB','tFTEN','tFWSH');

    foreach($teamF_checkbox as $check)  {

        if(is_array($_POST['teamFsel']) && in_array($check, $_POST['teamFsel'])) {
            $_SESSION[$check] = true;
        } else {
            $_SESSION[$check] = false;
        }
    }

} else {
		$positionFsel = $_POST['positionFsel'];
		$teamFsel = $_POST['teamFsel'];
}

?>

	<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapselimit" aria-expanded="false" aria-controls="collapselimit">
	  Limit Scouting
	</button>
	<div class="collapse container-fluid" id="collapselimit">
	
	<form role="form" method="post" action="">
	<div class="panel panel-default">
	
		<div class="panel-body">
		<h3>Limit Scouting to include at least 1 player with following critera</h3>
			<p><b>Teams</b><br></p>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFBUF' <?PHP if($_SESSION['tFBUF']) { echo 'checked'; }?> >BUF</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFARZ' <?PHP if($_SESSION['tFARZ']) { echo 'checked'; }?> >ARZ</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFATL' <?PHP if($_SESSION['tFATL']) { echo 'checked'; }?> >ATL</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFBAL' <?PHP if($_SESSION['tFBAL']) { echo 'checked'; }?> >BAL</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFCAR' <?PHP if($_SESSION['tFCAR']) { echo 'checked'; }?> >CAR</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFCHI' <?PHP if($_SESSION['tFCHI']) { echo 'checked'; }?> >CHI</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFCIN' <?PHP if($_SESSION['tFCIN']) { echo 'checked'; }?> >CIN</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFCLE' <?PHP if($_SESSION['tFCLE']) { echo 'checked'; }?> >CLE</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFDAL' <?PHP if($_SESSION['tFDAL']) { echo 'checked'; }?> >DAL</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFDEN' <?PHP if($_SESSION['tFDEN']) { echo 'checked'; }?> >DEN</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFDET' <?PHP if($_SESSION['tFDET']) { echo 'checked'; }?> >DET</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFGB' <?PHP if($_SESSION['tFGB']) { echo 'checked'; }?> >GB</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFHOU' <?PHP if($_SESSION['tFHOU']) { echo 'checked'; }?> >HOU</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFIND' <?PHP if($_SESSION['tFIND']) { echo 'checked'; }?> >IND</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFJAX' <?PHP if($_SESSION['tFJAX']) { echo 'checked'; }?> >JAX</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFKC' <?PHP if($_SESSION['tFKC']) { echo 'checked'; }?> >KC</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFMIA' <?PHP if($_SESSION['tFMIA']) { echo 'checked'; }?> >MIA</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFMIN' <?PHP if($_SESSION['tFMIN']) { echo 'checked'; }?> >MIN</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFNE' <?PHP if($_SESSION['tFNE']) { echo 'checked'; }?> >NE</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFNO' <?PHP if($_SESSION['tFNO']) { echo 'checked'; }?> >NO</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFNYG' <?PHP if($_SESSION['tFNYG']) { echo 'checked'; }?> >NYG</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFNYJ' <?PHP if($_SESSION['tFNYJ']) { echo 'checked'; }?> >NYJ</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFOAK' <?PHP if($_SESSION['tFOAK']) { echo 'checked'; }?> >OAK</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFPHI' <?PHP if($_SESSION['tFPHI']) { echo 'checked'; }?> >PHI</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFPIT' <?PHP if($_SESSION['tFPIT']) { echo 'checked'; }?> >PIT</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFSD' <?PHP if($_SESSION['tFSD']) { echo 'checked'; }?> >SD</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFSEA' <?PHP if($_SESSION['tFSEA']) { echo 'checked'; }?> >SEA</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFSF' <?PHP if($_SESSION['tFSF']) { echo 'checked'; }?> >SF</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFSTL' <?PHP if($_SESSION['tFSTL']) { echo 'checked'; }?> >STL</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFTB' <?PHP if($_SESSION['tFTB']) { echo 'checked'; }?> >TB</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFTEN' <?PHP if($_SESSION['tFTEN']) { echo 'checked'; }?> >TEN</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamFsel[]' value='tFWSH' <?PHP if($_SESSION['tFWSH']) { echo 'checked'; }?> >WSH</label>



			<p><b>Position:</b><br></p>
		
				<label class='checkbox-inline'><input type='checkbox' name='positionFsel[]' value='pFQB' <?PHP if($_SESSION['pFQB']) { echo 'checked'; }?> >Quarterbacks</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionFsel[]' value='pFRB' <?PHP if($_SESSION['pFRB']) { echo 'checked'; }?> >Running Backs</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionFsel[]' value='pFWR' <?PHP if($_SESSION['pFWR']) { echo 'checked'; }?> >Wide Receivers</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionFsel[]' value='pFTE' <?PHP if($_SESSION['pFTE']) { echo 'checked'; }?> >Tight Ends</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionFsel[]' value='pFOL' <?PHP if($_SESSION['pFOL']) { echo 'checked'; }?> >Offensive Line</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionFsel[]' value='pFDL' <?PHP if($_SESSION['pFDL']) { echo 'checked'; }?> >Defensive Line</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionFsel[]' value='pFLB' <?PHP if($_SESSION['pFLB']) { echo 'checked'; }?> >Linebackers</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionFsel[]' value='pFS_CB' <?PHP if($_SESSION['pFS_CB']) { echo 'checked'; }?> >Cornerbacks/Safeties</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionFsel[]' value='pFSpec' <?PHP if($_SESSION['pFSpec']) { echo 'checked'; }?> >Special Teamers</label>

				

			<div>
			<input name="submitted" type="submit" class="btn btn-success btn-lg" value="Update"/>
			

			<input type="button" class="btn btn-default btn-lg" id="CheckAll" value="Check All" />
			<input type="button" class="btn btn-default btn-lg" id="UncheckAll" value="Clear All" />
			</div>	
		</form>
			</div>
	</div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.cookie/1.4.0/jquery.cookie.min.js"></script>

    <script>
      $(":checkbox").on("change", function(){
        var checkboxValues = {};
        $(":checkbox").each(function(){
          checkboxValues[this.id] = this.checked;
        });
        $.cookie('checkboxValues', checkboxValues, { expires: 7, path: '/' })
      });

      function repopulateCheckboxes(){
        var checkboxValues = $.cookie('checkboxValues');
        if(checkboxValues){
          Object.keys(checkboxValues).forEach(function(element) {
            var checked = checkboxValues[element];
            $("#" + element).prop('checked', checked);
          });
        }
      }

      $.cookie.json = true;
      repopulateCheckboxes();




      function uncheckAll(){
 	  	$("input[type='checkbox']:checked").prop("checked",false)
		}
		$("#UncheckAll").click(function(){
		    $("input[type='checkbox']").prop('checked',false);
		});


		$("#CheckAll").click(function(){
		    $("input[type='checkbox']").prop('checked',true);
		})
    </script>