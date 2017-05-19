<?php 
class ElGamalUtil {
    private $publicKey;
    private $privateKey;
    
    private $alpha = "!\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~ π®ƒ©∆";
    private $p = 91744613;
    private $gen = 69;
    
    public function ElGamalUtil(){
        $C = (int)round(sqrt(random() * random()) * (p - 2) + 2);
        $privateKey = C +"";
        $publicKey = p + " "+$gen+ " "+ strval($gen).modPow(BigInteger.strval(C),BigInteger.strval(p));
    }
    
    
    private function decrypt($params){
        if (is_array($params)) {
            $x = strval(a[1]);
            $P = strval(p);
            $y = strval(a[0]).modPow(new BigInteger("-"+privateKey), P);
            $D = x.multiply(y).mod(P);
            $d = round(D.intValueExact()) % p;
            $d %= strlen($alpha);
            return alpha.charAt(d - 2) + "";
        }
        else{
            $n = (int) ceil($params.length() / 8);
            $x;
            while ($n-- > 0) {
                $x = $params.charAt(8 * n + 4) + "";
                $x += $params.charAt(8 * n + 5) +"";
                $x += $params.charAt(8 * n + 6) +"";
                $x += $params.charAt(8 * n + 7) +"";
                $m.add(0, x);
                $x = $params.charAt(8 * n) +"";
                $x += $params.charAt(8 * n + 1) +"";
                $x += $params.charAt(8 * n + 2) +"";
                $x += $params.charAt(8 * n + 3) +"";
                $m.add(0, x);
            }
            $x2 = array();
            $n = $m.size() / 2;
            // System.out.println("N => " + n);
            while ($n-- > 0) {
                $x2[0] = m.get(2 * n);
                $x2[1] = m.get(2 * n + 1);
                $x2[0] = to10($x2[0]);
                $x2[1] = to10($x2[1]);
                $d.add(decrypt(new int[]{
                    Integer.parseInt($x2[0]),
                    Integer.parseInt($x2[1]),
                }));
            }
            $params = ""; 
            for(String item : d){
                $params += item;
            }


            return $params;
        }
    }
        
    public int[] convertPublicKey(String key){
        String[] split = key.split(" ");
        int[] result = new int[split.length];
        for($i=0; i < result.length; i++){
            result[i] = Integer.parseInt(split[i]);
        }
        return result;        
    }
    
    public String join(ArrayList<String> key){
        String result = "";
        for(String item : key){
            result += item;
        }
        return result;        
    }
    
    private BigInteger[] encrypt(int[] key, String d){
        $k = (int)ceil(sqrt(random() * random()) * 1E10);
        $d2 = alpha.indexOf(d) + 2;
        BigInteger[] a = new BigInteger[2];
        a[0] = strval(key[1]).modPow(strval(k), strval(key[0])); //modPow(key[1], k, key[0]);
        a[1] = strval(d2).multiply(strval(key[2]).modPow(strval(k), strval(key[0]))).mod(strval(key[0])); //(d * modPow(key[2], k, key[0])) % key[0];
        return a;
    }
    
    public String encrypt(String message){
        int[] key2 = convertPublicKey(publicKey);
        ArrayList<String> y = new ArrayList<>();
        String[] message2 = message.split("");
        $n = message.length();
        while (n-- >0) {
            BigInteger[] x = encrypt(key2, message.charAt(n) + "");
            y.add(toAlpha(x[0]));
            y.add(toAlpha(x[1]));
        }
        return join(y);
    }
    
    public String toAlpha(BigInteger x){
        if (x.intValue() == 0) {
            return "!!!!";
        }
        ArrayList<String> y = new ArrayList<>();
        $n = 4;
        while (n-- > 0) {
            $p = (int)pow(alpha.length(), n);
            $l = (int)floor(x.divide(strval(p)).intValue());
            y.add(alpha.charAt(l) +"");
            x = x.subtract(strval(l * p));
        }
        return join(y);
    }
    
    private String to10(String x){
        $y = 0;
        $p = 1;
        String[] x2 = x.split("");
        $n = x2.length;
        while (n-- > 0) {
            y += alpha.indexOf(x2[n]) * p;
            p *= alpha.length();
        }
        return y + "";

    }
    
    public String getPublicKey() {
        return publicKey;
    }

    public void setPublicKey(String publicKey) {
        this.publicKey = publicKey;
    }

    public String getPrivateKey() {
        return privateKey;
    }

    public void setPrivateKey(String privateKey) {
        this.privateKey = privateKey;
    }
    
    
}

?>