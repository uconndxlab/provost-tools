<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OneLogin\Saml2\Auth as SamlAuth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Intended to be a GET route that redirects you to the CAS login page.
     */
    public function samlLogin(Request $request) {
        // Load the config/saml.php settings
        $auth = new SamlAuth(config('saml'));

        // returnTo, parameters, forceAuthn, isPassive, stay, setNameIdPolicy
        $redirectUrl = $auth->login($request->redirect ?? null, [], false, false, true);

        // Saves a reference to our Saml request
        $request->session()->put('samlAuthNRequestID', $auth->getLastRequestID());

        // Return a redirect to the CAS page.
        return redirect($redirectUrl);
    }


    /**
     * Intended to be a POST request from the SAML provider that posts the SAML response.
     */
    public function samlAcs(Request $request) {
        $auth = new SamlAuth(config('saml'));

        $auth->processResponse($request->get('samlAuthNRequestID'));

        if ( count($auth->getErrors()) > 0 || !$auth->isAuthenticated() ) {
            return redirect('/')->withErrors($auth->getErrors());
        }

        //  At this point we should have a valid SAML response and user.
        $saml_user_attributes = $auth->getAttributesWithFriendlyName();

        // Retrieve or get a new user based on the email address.
        $saml_user = User::firstOrNew(['netid' => $auth->getNameId()]);
        $saml_user->netid = $auth->getNameId();
        $saml_user->name = $saml_user_attributes['FirstName'][0] . ' ' . $saml_user_attributes['LastName'][0];
        $saml_user->email = $saml_user_attributes['Email'][0];
        $saml_user->affiliation = $saml_user_attributes['eduPersonPrimaryAffiliation'][0] ?? null;
        $saml_user->save();

        // Set an expiration variable to the session based on what SAML told us.
        $request->session()->put('samlExpire', $auth->getSessionExpiration());

        // Get the page that we are trying to access initially.
        $relay = $request->input('RelayState');

        Auth::login($saml_user);

        if ( $relay && $relay !== route('saml.login') ) { return redirect($relay); }

        return redirect()->route('home');
    }


    public function samlLogout(Request $request) {
        $auth = new SamlAuth(config('saml'));
        $auth->logout();
    }

    public function processSamlLogout(Request $request) {
        $auth = new SamlAuth(config('saml'));
        $auth->processSLO();
        $request->session()->forget('samlExpire');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect()->route('home');
    }
}
