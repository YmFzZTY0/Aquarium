# The Aquarium

Basically my own little phishing project (get it? aquarium?) that lets you easly steal some creds.
Use responsibly and LEGALY!, I'm not responsible for any dumb things you'd do with this project.

### How it works
First, the user is being redirected to the attacker's website.
After that the code will fetch the page for the user and serve it to the user, while adding a script to fetch the results.

### How to use it
Easily,
1. upload the code
2. create a url that looks something like this http[s]://mywebsite/r/http[s]://target.com/login
	> Example: https://mywebsite/r/https://facebook.com/login
3. send the link
4. after the user will submit the form, Check under Logs/stolen.log
5. Logs/main.log is for watching from where and when the user accessed our website

Enjoy! No updates will come so patch your own sh!t