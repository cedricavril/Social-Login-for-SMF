**Usage**

French and spanish languages are included. Message me if any problem with making it work or any trouble to understand what to do. This Social Login package had to be done done after many changes occured in SMF and FB and relatives apps, making any SL plugin deprecated.

Please follow the notice here as I didn't make any admin page tool for it.

No big deal, you just have to get your free-of-charge **id** and **secret id** to make it work – and make some config in the SL admin pages, that will be explained later on – as I guess there's no chance for us to get them with SMF. If someone wants to create them for SMF though, kindly get in touch with me, that would avoid to have to work on those boring compulsory configurations.

You may upgrade that version by yourself if you're good at *PHP* and *Jquery* together with *Oauth 2*. This is the first version of this SL, which requires to get two network app with their keys and FB's law stuff files. Social networks are FB and LinkedIn.

The good news with this package is you don't have to generate any token each month. The only thing to change in the package files to make it work is `./social_login/accounts/networks.json` content. Like I said before, get your id and secret keys for each SL and insert them in the json files this way :

`{"keys":[{"network":"Facebook","id":"<your FB id>","secret":"<your FB secret key>"},{"network":"LinkedIn","id":"<your LI id>","secret":"<your LI secret key>"}]}`

How to get them :

FB configuration :

Go to [https://developers.facebook.com](https://developers.facebook.com/) and create a Facebook Login app. Fill in the required data in the corresponding fields. Many fields are optional. You'll have to switch the *app Mode: Development* to Live mode to make it work, at the top of the page. Prior to it, you first have to add two law urls stuff regarding your forum. Click on *Settings -> basic* in left nav margin and add the Privacy Policy URL and User data deletion URL. You can find auto generated text for these files on the web.

Click on Facebook Login at the end of left nav margin. In the *Valid OAuth Redirect URIs* big field, you have to add these URLs at least :

-------------------------------------------------------------------------------
`<your root SMF url>/index.php?action=login`

`<your root SMF url>/social_login`

`<your root SMF url>/social_login?Facebook`

-------------------------------------------------------------------------------
Don't forget to click on Save changes at the bottom of the page. You'll find your app keys in *Settings > Basic* area.

LinkedIn configuration :

Dashboard is at [https://www.linkedin.com/developers](https://www.linkedin.com/developers)

It's easier as you just have to choose a company so you can get your keys afterwards. Product to choose is called "Sign In with LinkedIn". Just don't forget to add the same redirect urls as in your FB's dev dashboard, changing the get var link from `?Facebook` to `?LinkedIn`

**How it works**

Once the user is connected from his SL account and back to your SMF, the SMF connection credentials will be auto typed in the login fields. Jquery is in charge of handling the javascript stuff, so please wait a few seconds for the connection to be done. The name, and sometimes the picture, from the SL account data are registered and recorded in SMF's db prior to it if this is the first time the user connects. Password is randomisely created and is no use as the SL is in charge of the connection.

**Recommended**

The `accounts.json`  file has to be manually edited when it's time to remove or change some user's credential. Passwords are not encryted in there but `.htaccess` file protects the access to the folder. Therefore, clients share their SL pass with the site main administrator, somehow.

You should then add this kind of notice to your SMF forum :

About the Social login buttons

1. Use them with caution, you would get multiple nicks in the forum when you post with different logins.

2. Deleting a social login account in SMF won't allow you to use it again here, so refer your social login to the administrator in case you want to use it again.

3. Do NOT change the auto-generated password in case you could get it, as it won't let you auto-connect again by clicking on the SL button. If you really want to change it, share it with the administrator.

4. Report here any glitch, and post any remark or suggestion in this topic.