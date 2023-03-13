<?php
/**
 * Created by Chris on 9/29/2014 3:57 PM.
 */

class UserLogin {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $isLoggedIn;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('sessions/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if(!$user) {
            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);

                if($this->find($user)) {
                    $this->isLoggedIn = true;
                } else {
                    //Logout
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('userlogin', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }
    }

    public function update($fields = array(), $id = null) {

        if(!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if(!$this->_db->update('userlogin', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }

    public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('userlogin', array($field, '=', $user));

            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function login($username = null, $password = null) {
        if(!$username && !$password && $this->exists()) {
            Session::put($this->_sessionName, $this->data()->id);
        } else {
            $user = $this->find($username);
			
					if ($user && $this->data()->password === Hash::make($password)){
						Session::put($this->_sessionName, $this->data()->id);

						return true;
					}else{
						Session::flash('IncorrectPass', 'Incorrect username or password.');
					}
        }
        return false;
    }
	
	public function isAdmin() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->is_admin == true){
				return true;
			}
		}
		return false;
    }

    public function isSuperAdmin() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_admin'){
				return true;
			}
		}
		return false;
    }
	
	public function isCampusDirector() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_cd'){
				return true;
			}
		}
		return false;
    }
	
	public function isUser() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_user'){
				return true;
			}
		}
		return false;
    }
	
	public function isTeacher() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_teacher'){
				return true;
			}
		}
		return false;
    }
	
	public function isOjtAdmin() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_ojt_admin'){
				return true;
			}
		}
		return false;
    }
	
	public function isQaAdmin() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_qa_admin'){
				return true;
			}
		}
		return false;
    }
	
	public function isLibraryAdmin() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_library_admin'){
				return true;
			}
		}
		return false;
    }
	
	public function isResearchAdmin() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_research_admin'){
				return true;
			}
		}
		return false;
    }
	
	public function isExtensionAdmin() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_ex_admin'){
				return true;
			}
		}
		return false;
    }
	
	public function isOjtStudent() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_ojt'){
				return true;
			}
		}
		return false;
    }
	
	public function isOjtStudentApproved() {
        $verified = $this->_db->get('trainees', array('login_id', '=', $this->data()->login_id));
		
		foreach($verified->results() as $verified){
			if ($verified->registered == true){
				return true;
			}
		}
		return false;
    }
	
	public function isElStudent() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_elstudent'){
				return true;
			}
		}
		return false;
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function logout() {
        $this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }
}