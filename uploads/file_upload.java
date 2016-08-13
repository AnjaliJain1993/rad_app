import java.net.URL;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.io.*;
class File_Upload{
	public static void main(String[] args){
		try{
			HttpURLConnection httpUrlConnection = (HttpURLConnection)new URL("http://52.27.54.85/rad_app/uploads/file_upload.php?filename=pic.png").openConnection();
			httpUrlConnection.setDoOutput(true);
			httpUrlConnection.setRequestMethod("GET");
			OutputStream os = httpUrlConnection.getOutputStream();
			Thread.sleep(1000);
			File file =new File("pic.png");
			BufferedInputStream fis = new BufferedInputStream(new FileInputStream(file));
			long totalByte=file.length();
			int byteTrasferred=0;
			for (int i = 0; i < totalByte; i++) {
				os.write(fis.read());
				byteTrasferred++;
			}
			os.close();
			BufferedReader in = new BufferedReader(new InputStreamReader(httpUrlConnection.getInputStream()));
			String s = null;
			while ((s = in.readLine()) != null) {
				System.out.println(s);
			}
			in.close();
			fis.close();
			}
			catch (Exception e1) {
				e1.printStackTrace();
			} 
		}
	}

