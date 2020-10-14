import java.net.*;
import java.io.*;

public class daytimeClient {

  public static void main(String[] args) {

    Socket theSocket;
    String hostname;
    DataInputStream theTimeStream;

    if (args.length > 0) {
      hostname = args[0];
    }
    else {
      hostname = "localhost";
    }

    try {
      theSocket = new Socket(hostname, 13);
      theTimeStream = new DataInputStream(theSocket.getInputStream());
      String theTime = theTimeStream.readLine();
      System.out.println("It is " + theTime + " at " + hostname);
    }  // end try
    catch (UnknownHostException e) {
      System.err.println(e);
    }
    catch (IOException e) {
      System.err.println(e);
    }

  }  // end main

} // end daytimeClient
