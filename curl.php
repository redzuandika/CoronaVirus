<?php

function http_request($url)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //set local
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    //hasil in var
    $output = curl_exec($ch);

    //close
    curl_close($ch);

    return $output;
}

//call function
$data = http_request("https://api.kawalcorona.com/indonesia/provinsi/");

//convert to json
$data = json_decode($data, TRUE);

/*echo "<pre>";
print_r($data);
echo "</pre>"; */
$jumlah = count($data);
$nomor = 1;
for ($i = 0; $i < $jumlah; $i++) {
    $hasil = $data[$i]['attributes'];
?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td><?= $hasil['Provinsi'] ?></td>
        <td><?= $hasil['Kasus_Posi'] ?></td>
        <td><?= $hasil['Kasus_Semb'] ?></td>
        <td><?= $hasil['Kasus_Meni'] ?></td>
    </tr>

<?php
}
?>