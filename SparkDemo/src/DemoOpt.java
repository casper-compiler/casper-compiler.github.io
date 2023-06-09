import java.io.IOException;
import org.apache.hadoop.io.LongWritable;
import org.apache.hadoop.io.Text;
import org.apache.hadoop.mapred.TextInputFormat;
import org.apache.spark.SparkConf;
import org.apache.spark.api.java.JavaPairRDD;
import org.apache.spark.api.java.JavaRDD;
import org.apache.spark.api.java.JavaSparkContext;
import org.apache.spark.api.java.function.Function;
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

import scala.Tuple2;

public class DemoOpt {
	public static void main( String[] args ) throws IOException {
		JavaSparkContext ctx = new JavaSparkContext(new SparkConf().setAppName("demo").setMaster("local[*]"));
		JavaPairRDD<LongWritable, Text> lines = ctx.hadoopFile(args[0], TextInputFormat.class, LongWritable.class, Text.class);
		// using flat map converting lines into numbers
		JavaRDD<YelpKids.Restaurant> rests = lines.map(new Function<Tuple2<LongWritable, Text>, YelpKids.Restaurant>() {
			private static final long serialVersionUID = 1L;
			@Override
			public YelpKids.Restaurant call(Tuple2<LongWritable, Text> line) throws Exception {
				YelpKids.Restaurant r = new YelpKids.Restaurant();
				String[] data = line._2.toString().split("\\s");
            	r.state = data[0];
            	r.city = data[1];
            	r.comment = data[2];
            	r.score = Integer.parseInt(data[3]);
            	r.goodForKids = Boolean.parseBoolean(data[4]);
            	return r;
			}
		});

		// Open input file from HDFS
		Configuration conf = new Configuration();
    	conf.addResource(new Path("/etc/hadoop/conf/core-site.xml"));
    	conf.addResource(new Path("/etc/hadoop/conf/hdfs-site.xml"));
    	conf.set("fs.hdfs.impl", org.apache.hadoop.hdfs.DistributedFileSystem.class.getName());
	    conf.set("fs.file.impl", org.apache.hadoop.fs.LocalFileSystem.class.getName());
    	FileSystem hdfs = FileSystem.get(conf);
    	
    	// Open output file in HDFS
        OutputStream os = hdfs.create(new Path(args[1]), true);
        BufferedWriter bw = new BufferedWriter( new OutputStreamWriter(os) );

		Map<String,Integer> out = YelpKids.reviewCount(rests);
        
        for(String key: out.keySet())
        	bw.write(key + ", " + out.get(key) + "\n");
        
        bw.close();
	}
}
