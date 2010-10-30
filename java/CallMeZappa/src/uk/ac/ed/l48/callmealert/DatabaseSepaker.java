package uk.ac.ed.l48.callmealert;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Date;

import com.zappa.sdk.PhoneCaller;


public class DatabaseSepaker {

	public static void main(String args[]) {
		DatabaseSepaker ds = new DatabaseSepaker();
		ds.loopstuff();
	}

	public void loopstuff(){
		while(true){
			Object[] idAndNum = getImpendingCalls();
			int[] ids = (int[])idAndNum[0];
			if (ids[0] != -1) {
				String[] sds = (String[])idAndNum[1];
				PhoneCaller c = new PhoneCaller();

				for(int i = 0; i < ids.length; i++) {

					System.out.println("Commiting a call");
					c.callUrl(sds[i], ids[i]);
				}
			}
			try {
				Thread.sleep(60 * 1000);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
	}

	// Access the database and retrieve call_id's and phone numbers
	public Object[] getImpendingCalls(){
		int[] ids = new int[]{};
		String[] sds = new String[]{};
		Connection con = null;
		Date date = new Date();
		//java.sql.Date date = new java.sql.Date();
		long thetime = date.getTime() / 1000;


		try {
			Class.forName("com.mysql.jdbc.Driver");
			con=DriverManager.getConnection("jdbc:mysql://localhost/zappa","root", "password");
			Statement st = con.createStatement();
			ResultSet rs = st.executeQuery("select * from tbl_job_queue where UNIX_TIMESTAMP(time) < " + (thetime + 300));
			
			rs.last();
			int length = rs.getRow();
			rs.first();
			
			ids = new int[length];
			sds = new String[length];
			
			int i = 0;

			if(length > 0) {
				do
				{
					ids[i] = rs.getInt(2);
					sds[i] = rs.getString(3);
					//System.out.println("id:" + rs.getString(1));
				} while(rs.next());

				//st.execute("DELETE FROM tbl_job_queue WHERE UNIX_TIMESTAMP(time) < " + (thetime + 300));
			} else {
				ids = new int[]{-1};
				sds = new String[]{};
			}
		} catch(Exception e) {
			e.printStackTrace();
			System.out.println("Exception: " + e.getMessage());
		} finally {
			try {
				if(con != null)
					con.close();
			} catch(SQLException e) {}
		}

		Object[] ret = new Object[] {(Object)ids, (Object)sds};
		return ret;
	}
}
