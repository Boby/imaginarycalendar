<!DOCTYPE html>
<html> 
<body>
<?php
function showday($day, $month, $year) {
    $allDays = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $leapInterval = 5;
    $numofdays = 7;
    $startday = 1;
    $data = array('d' => $day, 'm' => $month, 'y' => $year);
    //print_r($data);
    $leaps = floor(($data['y'] - 1990) / $leapInterval + 1);
    $prevleap = $leaps % $numofdays;

    $newday = $startday - $prevleap;

    if ($newday < 0) {
        $firstday = $startday + $numofdays - $prevleap;
    } else {
        $firstday = $newday;
    }

    $oddmonths = floor($data['m'] / 2);

    $firstmonth = ($firstday + $oddmonths) % $numofdays;

    $day = ($firstmonth + $data['d']-1) % $numofdays;

    return $allDays[$day];
}

//17 11 2013
print '17-11-2013 is '.showday(17, 11, 2013);

function loadcalendar() {

    print "<div id='loadcalendar'>";

    $year = 1990;
    $totalDays = 0;

    while ($year < 2018) {

        print "<h1>$year</h1><table>";
        $month = 1;
        while ($month < 14) {
            print "<tr class='monthrow'><td colspan='7'><b>Month $month</b></td></tr>";
            print "<tr class='dayshead'><td>Monday</td><td>Tuesday</td><td>Wednesday</td><td>Thursday</td><td>Friday</td><td>Saturday</td><td>Sunday</td></tr>";

            $dayCount = ($month % 2 == 1) ? 22 : 21;
            $dayCount = ($month == 13 && $year % 5 == 0) ? 21 : $dayCount;

            $day = 1;

            print "<tr class='dayrow'>";
            while ($day <= $dayCount) {
                $index = ++$totalDays % 7;
                if ($day == 1) {
                    for ($i = 0; $i < $index-1; $i++) {
                        print "<td></td>";
                    }
                    if ($index == 0 || $index == 7) {
                        $i = 6;
                        while ($i--) {
                            print "<td></td>";
                        }
                    }
                }
                print "<td>$day</td>";
                if ($index == 0) {
                    print "</tr><tr class='dayrow'>";
                }
                $day++;
            }
            print "</tr>";
            $month++;
        }
        print "</table><hr />";
        $year++;
    }

    print "</div>";
}

loadcalendar();
?>
</body>
</html>