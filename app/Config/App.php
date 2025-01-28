<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{

	public $baseURL = 'http://localhost/public';
	public $indexPage = 'index.php';
	public $uriProtocol = 'REQUEST_URI';
	public $defaultLocale = 'es';
	public $negotiateLocale = false;
	public $supportedLocales = ['es'];
	public $appTimezone = 'America/Buenos_Aires';
	public $charset = 'UTF-8';
	public $forceGlobalSecureRequests = false;
	public $sessionDriver            = 'CodeIgniter\Session\Handlers\FileHandler';
	public $sessionCookieName        = 'ci_session';
	public $sessionExpiration        = 7200;
	public $sessionSavePath          = WRITEPATH . 'session';
	public $sessionMatchIP           = false;
	public $sessionTimeToUpdate      = 300;
	public $sessionRegenerateDestroy = false;
	public $cookiePrefix   = '';
	public $cookieDomain   = '';
	public $cookiePath     = '';
	// public $cookiePath     = '/';
	public $cookieSecure   = false;
	public $cookieHTTPOnly = false;
	public $CSRFTokenName  = 'csrf_test_name';
	public $CSRFHeaderName = 'X-CSRF-TOKEN';
	public $CSRFCookieName = 'csrf_cookie_name';
	public $CSRFExpire     = 7200;
	public $CSRFRegenerate = true;
	public $CSRFRedirect   = true;
	public $CSPEnabled = false;
	
	// public $proxyIPs = ['1.2.3.4, 2.3.4.5'];
	public $proxyIPs = [];
	public array $allowedHostnames = [];

}
