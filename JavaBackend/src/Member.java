
public class Member {
	
    String id;
    String first_name;
    String middle_name;
    String last_name;
    String suffix;
    String chamber;
    String party;
    String twitter_account;
    String facebook_account;
    String youtube_account;
    String url;
    String contact_form;
    String phone;
    String state;
    String senate_class;
	
	public String toString() {
		return "\"id\": " + id
			+ "\"first_name\": " + first_name
			+ "\"middle_name\": " + middle_name
			+ "\"last_name\": " + last_name;
	}
}
