<div class="modal jd-info_modal" id="jdInfo">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <p class="modal-title">History Logs</p>
        <button type="button" class="btn btn-default p-1" data-dismiss="modal">Close</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

		<?php
			$prevDate  = "";

			foreach ($jdHistory as $key => $value) {
				$dateTime 	= date_create($jdHistory[$key]->action_datetime);
				$toDate		= date_format($dateTime, 'Y-m-d');
				$toTime 	= date_format($dateTime, 'h:i:s A');

				$user 		= $jdHistory[$key]->user;
				$action 	= $jdHistory[$key]->action;

				// temporary solution, change the word inserted to created
				// must be the change in tbl_jd_hsitory, use created instead of inserted term

				if ($prevDate != $toDate) {
					if (date("Y-m-d") == $toDate) {
						echo('<p class="subtitle">Today</p>');
					} else {
						echo('<p class="subtitle">' . $toDate . '</p>');
					}
				}

				echo "<div class='item'>";
				echo "<div>". $user ."</div>";
				echo "<div>". $action ."</div>";
				echo "<div>". $toTime ."</div>";
				echo "</div>";
				
				$prevDate = $toDate;
			}
		?>
    	
      </div>

    </div>
  </div>
</div>