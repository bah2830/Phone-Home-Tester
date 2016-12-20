<?php
$db = new SQLite3('/database/request_logger.db');

$allRequests = $db->query("SELECT
    hostname   AS hostname,
    max(ip_address) AS ip_address,
    max(request_type) as request_type,
    max(request_date) as request_date,
    max(os) as os,
    count(request_id) as count
FROM
    request
GROUP BY
    hostname
ORDER BY
    max(request_date) DESC");

$requests = [];
while ($row = $allRequests->fetchArray()) {
    $requests[] = $row;
}
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Requests</title>

        <link rel="stylesheet" href="/content/css/bootstrap.min.css">
        <link rel="stylesheet" href="/content/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Hostname</th>
                                <th>Ip Address</th>
                                <th>Operating System</th>
                                <th>Type</th>
                                <th>Count</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $host): ?>
                                <tr>
                                    <td><?=$host['hostname']?></td>
                                    <td><?=$host['ip_address']?></td>
                                    <td><?=$host['os']?></td>
                                    <td><?=$host['request_type']?></td>
                                    <td><?=$host['count']?></td>
                                    <td><?=$host['request_date']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>