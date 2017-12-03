import java.io.BufferedReader;
import java.io.IOException;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.util.List;
import java.util.Scanner;

import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

import com.google.gson.Gson;

public class Listener {
	
	static List<Member> memberList;
	
	public Listener( List<Member> memberList ) throws IOException {
		
		this.memberList = memberList;
		
		for ( Member m : memberList ) {
			System.out.println(m.toString());
		}

        HttpServer server = HttpServer.create(new InetSocketAddress(8080), 0);
        server.createContext("/test", new MyHandler());
        server.setExecutor(null); // creates a default executor
        server.start();
    }

    static class MyHandler implements HttpHandler {
        @Override
        public void handle(HttpExchange t) throws IOException {
            System.out.println(t.getRequestURI().getQuery().toString());
            
            String query = t.getRequestURI().getQuery().toString();
            String parameter = query.substring(0,query.indexOf("="));
            String memberName = query.substring(query.indexOf("=")+1);
            
            parameter = parameter.toLowerCase();
            memberName = memberName.toLowerCase();
            
            System.out.println(parameter);
            System.out.println(memberName); 
            
            Gson gson = new Gson();
            String response = "";
            
            switch (parameter) {
	            case "all":
	            		System.out.println("Case All");
	            		
	            		response = "{\"results\":[";
	            		for (Member m : memberList) {
	            			
	            			response += "{\"first_name\":\"" + m.first_name + "\",\"middle_name\":\"" + m.middle_name + "\",\"last_name\":\"" + m.last_name + "\"},\n";
	            		}
	            		response = response.substring(0, response.length()-2);
	            		response += "]}";
		        		System.out.println(response);
		        		break;
		        		
	            case "name":
	            		System.out.println("Case Name");
	            		String localMemberName = "";
		            	for (Member m : memberList) {
		            		localMemberName = m.first_name + m.last_name;
		            		if (localMemberName.equals(memberName)) {
		            			response += gson.toJson(m);
		            			System.out.println("Adding");
		            		}
			        }
		            	System.out.println(response);
		            	break;
		            	
	            default:
	            		response = "failed";
		            		
            }
            System.out.println(response);
            System.out.println(response.length());
            
//            for (Member m : memberList) {
//            		response += gson.toJson(m);
//            		System.out.println("Adding");
//            }
            
            t.sendResponseHeaders(200, 0);
//            t.sendResponseHeaders(200, response.length());
            OutputStream os = t.getResponseBody();
            os.write(response.getBytes());
            os.flush();
            t.close();
        }
    }
	
}
