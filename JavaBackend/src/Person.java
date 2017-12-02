
public class Person {
	private String ID;
	private String CHAMBER;
	private String FIRST;
	private String MID;
	private String LAST;
	private String PARTY;
	private String TWITTER;
	private String FB;
	private String YT;
	private String URL;
	private String CONTACT_FORM;
	private String PHONE;
	private String STATE;
	
	public String toString() {
		return "\"id\": " + ID
			+ "\"first_name\": " + FIRST
			+ "\"middle_name\": " + MID
			+ "\"last_name\": " + LAST;
	}
}
