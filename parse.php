    <?php
      if (isset($_POST["checkoutlink"])) {
        // Get the checkout link from the user
        $checkoutlink = $_POST["checkoutlink"];

        // Decode the value after the '#' character
        $obfuscatedPK = urldecode(explode("#", $checkoutlink)[1]);

        // Decrypt the obfuscated PK
        $decoded = base64_decode($obfuscatedPK);
        $deobfed = "";
        foreach(str_split($decoded) as $c) {
            $deobfed .= chr(5 ^ ord($c));
        }

        // Parse the JSON data and extract the API key
        $shuroap = json_decode($deobfed, true);
        $pklive = $shuroap["apiKey"];

        // Set up the headers for the API request
        $headers = array(
            "Host: api.stripe.com",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/111.0",
            "Accept: application/json",
            "Accept-Language: en-US,en;q=0.5",
            "Accept-Encoding: gzip, deflate",
            "Referer: https://checkout.stripe.com/",
            "Content-Type: application/x-www-form-urlencoded",
            "Origin: https://checkout.stripe.com",
            "DNT: 1",
            "Connection: keep-alive",
            "Sec-Fetch-Dest: empty",
            "Sec-Fetch-Mode: cors",
            "Sec-Fetch-Site: same-site"
        );

        // Construct the POST request body
        $post_data = array(
            "key" => $pklive,
            "eid" => "NA",
            "browser_locale" => "en-US",
            "redirect_type" => "stripe_js"
        );
        $post_data_str = http_build_query($post_data);
        $cs_parts = explode("/", explode("#", $checkoutlink)[0]); $cslive = end($cs_parts);

        // Send the POST request to the Stripe API
        $url = "https://api.stripe.com/v1/payment_pages/".$cslive."/init";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data_str);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Parse the response JSON and extract the data
        $response_data = json_decode($response, true);

        if (isset($response_data["message"]) && $response_data["message"] === "This Checkout Session is no longer active.") {
        die("Error: This Checkout Session is no longer active.");
        }
        if (isset($response_data["line_item_group"]["line_items"][0]["total"])) {
            $amount = $response_data["line_item_group"]["line_items"][0]["total"];
        } elseif (isset($response_data["invoice"]["total"])) {
            $amount = $response_data["invoice"]["total"];
        } else {
            $amount = "Amount not found";
        }
        if (isset($response_data["customer"]["email"])) {
            $email = $response_data["customer"]["email"];
        } elseif (isset($response_data["customer_email"])) {
            $email = $response_data["customer_email"];
        } else {
            $email = "Email not found";
        }

        echo json_encode(array(
            "pklive" => $pklive, 
            "cslive" => $cslive, 
            "amount" => $amount, 
            "email" => $email
        ));
        
      }
    ?>

