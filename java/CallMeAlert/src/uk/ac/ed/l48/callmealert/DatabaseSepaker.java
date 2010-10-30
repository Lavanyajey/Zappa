package uk.ac.ed.l48.callmealert;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Date;

import com.zappa.sdk.*;


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
			ResultSet rs = st.executeQuery("select * from Job_Queue where UNIX_TIMESTAMP(time) < " + (thetime + 300));
			ids = new int[rs.getFetchSize()];
			sds = new String[rs.getFetchSize()];
			int i = 0;

			if(rs.getFetchSize() > 0) {
				while(rs.next())
				{
					ids[i] = rs.getInt(1);
					sds[i] = rs.getString(2);
					//System.out.println("id:" + rs.getString(1));
				}

				st.executeQuery("DELETE FROM Job_Queue WHERE UNIX_TIMESTAMP(time) < " + (thetime + 300));
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
