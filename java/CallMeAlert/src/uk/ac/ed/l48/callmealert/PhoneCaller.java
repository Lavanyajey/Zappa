package uk.ac.ed.l48.callmealert;
import java.util.HashMap;
import java.util.Map;

import com.twilio.sdk.TwilioRestClient;
import com.twilio.sdk.TwilioRestException;
import com.twilio.sdk.TwilioRestResponse;

public class PhoneCaller 
{
	public static final String APIVERSION = "2010-04-01";
	
	TwilioRestClient client;
	String AccountSid;
	String AuthToken;
	String CallerID;
	
	public PhoneCaller()
	{
	    this.AccountSid = "AC56723c8d36b0959f97ec6c4fd98173cd";
	    this.AuthToken = "29be9da2bff9ca19fced086e64bc395a";
	        
	    /* Outgoing Caller ID previously validated with Twilio */
	    this.CallerID = "7732432694";
	        
	    /* Instantiate a new Twilio Rest Client */
	    this.client = new TwilioRestClient(AccountSid, AuthToken, null);
	}
	
	public static void main(String args[])
	{
		
		PhoneCaller caller = new PhoneCaller();
		caller.callUrl("+447816816158", 1);
		
	}
	
	public void callUrl(String number, Integer messageId)
	{
		String urlAddress = String.format("http://zappa.latentflip.com/?r=call/get/id/%d", messageId);
		System.out.println("Message url: " + urlAddress);
		System.out.println("Telephone number to call: " + number);
		makeCall(this.client, this.CallerID, number, urlAddress);
	}
	
    public static void makeCall(TwilioRestClient client, String from, String to, String url ){

        //build map of post parameters 
        Map<String,String> params = new HashMap<String,String>();
        params.put("From", from);
        params.put("To", to);
        params.put("Url", url);
        TwilioRestResponse response;
        try {
            response = client.request("/"+APIVERSION+"/Accounts/"+client.getAccountSid()+"/Calls", "POST", params);
        
            if(response.isError())
                System.out.println("Error making outgoing call: "+response.getHttpStatus()+"\n"+response.getResponseText());
            else {
                System.out.println(response.getResponseText());

            }
        } catch (TwilioRestException e) {
            e.printStackTrace();
        }
    }
	
	
}
