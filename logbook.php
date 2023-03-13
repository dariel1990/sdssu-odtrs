<?php
require_once 'core/init.php';
$user = new UserLogin();

$action = $_POST['action'];
		
		switch ( $action ) {
			case 'view_student_info':	
				$visitor = DB:: getInstance()->get('libvisitors', array('idnumber','=',$_POST['idnumber']));
				
				if ($visitor->count()){
					foreach($visitor->results() as $visitor){
						$id = $visitor->idnumber;
						$fullname = $visitor->lname. ", " .$visitor->fname. " ".$visitor->mname ;
						$visitortype = $visitor->visitortype;
					}
					$logbook = new LibraryLogbook();
					try {
						$logbook->create(array(
							'idnumber' => $id,
							'timestamp' => date("F j, Y, g:i a"),
						));
								
						$msg = '<div class="alert alert-success" >
									<i class="glyphicon glyphicon-ok"></i> A visitor has logged in.
								</div>';
								
						Session::flash('Added', 'New visitor has been successfully logged in.');
						
						} catch(Exception $e) {
							$error;
						}
				}else{
					$id = 'record not found';
					$fullname = '';
					$visitortype = '';
					$msg = '<div class="alert alert-danger" >
								<i class="glyphicon glyphicon-remove"></i> This record is not registered.
							</div>';
							
					Session::flash('notFound', 'Record not registered.');
				}

				echo json_encode(['id'=>$id, 'fullname'=>$fullname, 'visitortype'=>$visitortype, 'msg'=>$msg]);
			break;

		 default:
				;
		}
?>