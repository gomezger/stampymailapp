<?php

class SessionController extends Controller
{

    private $userSession, $username, $userid, $sites, $defaultSites, $user;
    private Session $session;

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    private function init(): void
    {
        $this->session = new Session();
        $access = $this->getAccessFileConfig();
        $this->sites = $access['sites'];
        $this->defaultSites = $access['default-sites'];
        $this->validateSession();
    }

    private function getAccessFileConfig(): array
    {
        $access = file_get_contents('config/access.json');
        return json_decode($access, true);
    }

    public function validateSession()
    {

        if ($this->existsSession()) {

            // dejo seguir

        } else {

            if ( $this->isPrivate()) { 
                $this->redirectDefaultSite();
            }
        }
    }

    public function existsSession(): bool
    {
        if (!$this->session->exists() || $this->session->getCurrentUser() === null)
            return false;

        $userid = $this->session->getCurrentUser();
        return $userid ? true : false;
    }

    public function getUserSessionData(): UserModel {
        $id = $this->userid;
        $this->user = new UserModel();
        $this->user->find($id);
        return $this->user;
    }

    public function isPublic(): bool {
        $currentURL = $this->getCurrentPage();    
        $currentURL = preg_replace("/\?.*/", "", $currentURL);  
        
        $isPublic = false;
        for($i = 0; $i < sizeof($this->sites) && !$isPublic; $i++){
            $isPublic = $currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public';
        }
        return $isPublic;
    }

    public function isPrivate(): bool {
        return !$this->isPublic();
    }

    public function getCurrentPage(): string {
        $current = trim($_SERVER['REQUEST_URI']);
        $url = explode('/', $current);
        return (is_null($url[2])) ? '' : $url[2];
    }

    private function redirectDefaultSite(): void {
        header('location:' . constant('URL') . $this->defaultSites['unauthorized']);
    }

    public function initialize($user) {
        $this->session->setCurrentUser($user->getID());
        $this->authorizeAccess();
    }

    public function authorizeAccess() {
        header('location:' . constant('URL') . $this->defaultSites['authorized']);        
    }

    public function logout() {
        $this->session->closeSession();
        $this->redirectDefaultSite();
    }

}

