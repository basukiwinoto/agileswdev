public class HelloWorld {

    public static void main(String[] args) {
        try{
            System.out.println("Hello, "+args[0]+"!");
        }catch(Exception e){
            e.printStackTrace();
        }
    }
}
