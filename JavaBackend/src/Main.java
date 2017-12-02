import java.io.*;
import java.net.*;
import com.google.gson.Gson;

class Main {

	public static void main(String[] args) throws IOException {

		getMembers("https://api.propublica.org/congress/v1/115/senate/members.json", "senate");
		getMembers("https://api.propublica.org/congress/v1/115/house/members.json", "house");

	}

	private static void getMembers(String apiUrl, String chamber) throws IOException {
		// Make a URL to the web page
		URL url = new URL(apiUrl);

		// Get the input stream through URL Connection
		HttpURLConnection con = (HttpURLConnection) url.openConnection();
		// InputStream is =con.getInputStream();
		con.setRequestProperty("X-API-Key", "4RM24zjNtFxuAwYwaqdloMYskI7DSWYptP2OCOq");
		con.setRequestMethod("GET");
		BufferedReader br = new BufferedReader(new InputStreamReader(con.getInputStream()));
		String inputLine;
		StringBuffer content = new StringBuffer();
		// read each line and write to System.out
		while ((inputLine = br.readLine()) != null) {
			content.append(inputLine);
		}
		br.close();
		System.out.println(content.toString());

		Gson gson = new Gson();

		String newContent = "{NAME:\"ALBERT\"," + "P_LANGUAGE:\"java\"," + "LOCATION:\"malta\" }";
		Response r = gson.fromJson(content.toString(), Response.class);

		System.out.println(r.toString());
		System.out.println(r.results.get(0).members.get(0).first_name);
	}
}
