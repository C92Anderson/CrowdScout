<?php 
session_start();

if(isset($_POST['submitted'])) {

    $pos_checkbox = array('pG', 'pD', 'pW', 'pC');

    foreach($pos_checkbox as $check)  {

        if(is_array($_POST['positionsel']) && in_array($check, $_POST['positionsel'])) {
            $_SESSION[$check] = true;
        } else {
            $_SESSION[$check] = false;
        }
    }

    $team_checkbox = array('tANA','tARI','tBOS','tBUF','tCAR','tCBJ','tCGY','tCHI','tCOL','tDAL','tDET','tEDM','tFLA','tLAK','tMIN','tMTL','tNJD','tNSH','tNYI','tNYR','tOTT','tPHI','tPIT','tSJS','tSTL','tTBL','tTOR','tVAN','tWPG','tWSH');

    foreach($team_checkbox as $check)  {

        if(is_array($_POST['teamsel']) && in_array($check, $_POST['teamsel'])) {
            $_SESSION[$check] = true;
        } else {
            $_SESSION[$check] = false;
        }
    }

} else {
		$positionsel = $_POST['positionsel'];
		$teamsel = $_POST['teamsel'];
}


?>

	<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapselimit" aria-expanded="false" aria-controls="collapselimit">
	  Limit Scouting
	</button>
	<div class="collapse container-fluid" id="collapselimit">
	
	<form role="form" method="post" action=<?php //pairsimHKY(15) ; ?>>
	<div class="panel panel-default">
	
		<div class="panel-body">
		<h3>Limit Scouting to include at least 1 player with following critera</h3>
			<p><b>Teams</b><br></p>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tANA' <?PHP if($_SESSION['tANA']) { echo 'checked'; }?> >ANA</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tARI' <?PHP if($_SESSION['tARI']) { echo 'checked'; }?> >ARI</label>

				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tBOS' <?PHP if($_SESSION['tBOS']) { echo 'checked'; }?> >BOS</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tBUF' <?PHP if($_SESSION['tBUF']) { echo 'checked'; }?> >BUF</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tCAR' <?PHP if($_SESSION['tCAR']) { echo 'checked'; }?> >CAR</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tCBJ' <?PHP if($_SESSION['tCBJ']) { echo 'checked'; }?> >CBJ</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tCGY' <?PHP if($_SESSION['tCGY']) { echo 'checked'; }?> >CGY</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tCHI' <?PHP if($_SESSION['tCHI']) { echo 'checked'; }?> >CHI</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tCOL' <?PHP if($_SESSION['tCOL']) { echo 'checked'; }?> >COL</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tDAL' <?PHP if($_SESSION['tDAL']) { echo 'checked'; }?> >DAL</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tDET' <?PHP if($_SESSION['tDET']) { echo 'checked'; }?> >DET</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tEDM' <?PHP if($_SESSION['tEDM']) { echo 'checked'; }?> >EDM</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tFLA' <?PHP if($_SESSION['tFLA']) { echo 'checked'; }?> >FLA</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tLAK' <?PHP if($_SESSION['tLAK']) { echo 'checked'; }?> >LAK</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tMIN' <?PHP if($_SESSION['tMIN']) { echo 'checked'; }?> >MIN</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tMTL' <?PHP if($_SESSION['tMTL']) { echo 'checked'; }?> >MTL</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tNJD' <?PHP if($_SESSION['tNJD']) { echo 'checked'; }?> >NJD</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tNSH' <?PHP if($_SESSION['tNSH']) { echo 'checked'; }?> >NSH</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tNYI' <?PHP if($_SESSION['tNYI']) { echo 'checked'; }?> >NYI</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tNYR' <?PHP if($_SESSION['tNYR']) { echo 'checked'; }?> >NYR</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tOTT' <?PHP if($_SESSION['tOTT']) { echo 'checked'; }?> >OTT</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tPHI' <?PHP if($_SESSION['tPHI']) { echo 'checked'; }?> >PHI</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tPIT' <?PHP if($_SESSION['tPIT']) { echo 'checked'; }?> >PIT</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tSJS' <?PHP if($_SESSION['tSJS']) { echo 'checked'; }?> >SJS</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tSTL' <?PHP if($_SESSION['tSTL']) { echo 'checked'; }?> >STL</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tTBL' <?PHP if($_SESSION['tTBL']) { echo 'checked'; }?> >TBL</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tTOR' <?PHP if($_SESSION['tTOR']) { echo 'checked'; }?> >TOR</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tVAN' <?PHP if($_SESSION['tVAN']) { echo 'checked'; }?> >VAN</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tWPG' <?PHP if($_SESSION['tWPG']) { echo 'checked'; }?> >WPG</label>
				<label class='checkbox-inline'><input type='checkbox' name='teamsel[]' value='tWSH' <?PHP if($_SESSION['tWSH']) { echo 'checked'; }?> >WSH</label>


			<p><b>Position:</b><br></p>
		
				<label class='checkbox-inline'><input type='checkbox' name='positionsel[]' value='pG' <?PHP if($_SESSION['pG']) { echo "checked"; }?> >Goalies</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionsel[]' value='pD' <?PHP if($_SESSION['pD']) { echo "checked"; }?> >Defensemen</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionsel[]' value='pW' <?PHP if($_SESSION['pW']) { echo "checked"; }?> >Wingers</label>
				<label class='checkbox-inline'><input type='checkbox' name='positionsel[]' value='pC' <?PHP if($_SESSION['pC']) { echo "checked"; }?> >Centers</label>

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