import org.apache.spark.SparkConf;
import org.apache.spark.api.java.JavaSparkContext;
import org.apache.spark.api.java.JavaPairRDD;
import org.apache.spark.api.java.JavaRDD;
import org.apache.spark.api.java.function.Function2;
import org.apache.spark.api.java.function.PairFlatMapFunction;
import scala.Tuple2;
import java.util.ArrayList;
import java.util.Map;
import java.util.Iterator;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class YelpKids {
	public static class Restaurant {
		public String state;
		public String city;
		public String comment;
		public int score;
		public Boolean goodForKids;
		
		public Restaurant() { super(); }
	}
	
	
	public static java.util.Map<java.lang.String,java.lang.Integer> reviewCount(JavaRDD<YelpKids.Restaurant> data) {
		java.util.Map<java.lang.String,java.lang.Integer> result = null;
		result = new java.util.HashMap<java.lang.String,java.lang.Integer>();
		
		JavaPairRDD<String, java.lang.Integer> mapEmits = data.flatMapToPair(new PairFlatMapFunction<YelpKids.Restaurant, String, java.lang.Integer>() {
			public Iterator<Tuple2<String, java.lang.Integer>> call(YelpKids.Restaurant data_casper_index) throws Exception {
				List<Tuple2<String, java.lang.Integer>> emits = new ArrayList<Tuple2<String, java.lang.Integer>>();
				
				if(data_casper_index.goodForKids) emits.add(new Tuple2(data_casper_index.city, 1));
				
				
				return emits.iterator();
			}
		});
		
		JavaPairRDD<String, java.lang.Integer> reduceEmits = mapEmits.reduceByKey(new Function2<java.lang.Integer,java.lang.Integer,java.lang.Integer>(){
			public java.lang.Integer call(java.lang.Integer val1, java.lang.Integer val2) throws Exception {
				return (val1+val2);
			}
		});
		
		Map<String, java.lang.Integer> output_data = reduceEmits.collectAsMap();
		result = output_data;
		;
		return result;
	}
	
	public YelpKids() { super(); }
}
