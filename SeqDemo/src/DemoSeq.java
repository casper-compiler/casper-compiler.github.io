import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

import org.apache.hadoop.conf.Configuration;
import org.apache.hadoop.fs.FileStatus;
import org.apache.hadoop.fs.FileSystem;
import org.apache.hadoop.fs.Path;


public class DemoSeq {
	public static void main( String[] args ) throws IOException {
		// Open input file from HDFS
		Configuration conf = new Configuration();
    	conf.addResource(new Path("/etc/hadoop/conf/core-site.xml"));
    	conf.addResource(new Path("/etc/hadoop/conf/hdfs-site.xml"));
    	conf.set("fs.hdfs.impl", org.apache.hadoop.hdfs.DistributedFileSystem.class.getName());
	    conf.set("fs.file.impl", org.apache.hadoop.fs.LocalFileSystem.class.getName());
    	FileSystem hdfs = FileSystem.get(conf);
    	
    	// Get input files
    	FileStatus[] status = hdfs.listStatus(new Path(args[0]));
    	
    	// Open output file in HDFS
        OutputStream os = hdfs.create(new Path(args[1]), true);
        BufferedWriter bw = new BufferedWriter( new OutputStreamWriter(os) );
        
        // Read data
        List<YelpKids.Restaurant> rests = new ArrayList<YelpKids.Restaurant>();
        for (int i=0;i<status.length;i++){
        	BufferedReader br = new BufferedReader(new InputStreamReader(hdfs.open(status[i].getPath())));
            String line;
            line=br.readLine();
            
            while (line != null){
            	String[] data = line.split("\\s");
            	
            	YelpKids.Restaurant r = new YelpKids.Restaurant();
            	r.state = data[0];
            	r.city = data[1];
            	r.comment = data[2];
            	r.score = Integer.parseInt(data[3]);
            	r.goodForKids = Boolean.parseBoolean(data[4]);
            	rests.add(r);
            	
            	line=br.readLine();
            }
        }
        
        Map<String,Integer> out = YelpKids.reviewCount(rests);
        
        for(String key: out.keySet())
        	bw.write(key + ", " + out.get(key) + "\n");
        
        bw.close();
	}
}
