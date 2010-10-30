package uk.ac.ed.l48.callmealert;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Date;

public class DatabaseSepaker {

	public static void main(String args[]) {
		DatabaseSepaker ds = new DatabaseSepaker();
		ds.getImpendingCalls();
	}
	
	public void loopstuff(){
		while(true){
			int[] ids = getImpendingCalls();
			//THEM.TwiloFunc(ids);
			
			
			
			try {
				Thread.sleep(60 * 1000);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
	}
	
	public int[] getImpendingCalls(){
		int[] ids = new int[]{};
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
			int i = 0;
			while(rs.next())
			{
				ids[i] = rs.getInt(1);
				//System.out.println("id:" + rs.getString(1));
			}
			rs.first();
			
			do {
				rs.deleteRow();	
			} while(rs.next());
				
				
		} catch(Exception e) {
			e.printStackTrace();
			System.out.println("Exception: " + e.getMessage());
		} finally {
			try {
				if(con != null)
					con.close();
			} catch(SQLException e) {}
		}
		
		
		return ids;
	}
}
