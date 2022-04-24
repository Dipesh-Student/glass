<?php include_once(TEMP_PATH_HEADER); ?>

<!--========== CONTENTS ==========-->
<main>
    <section hidden>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt vel illum fuga unde cum, voluptates magni molestias eveniet culpa autem ut, totam veniam, suscipit tempore ullam pariatur est at asperiores?</p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt vel illum fuga unde cum, voluptates magni molestias eveniet culpa autem ut, totam veniam, suscipit tempore ullam pariatur est at asperiores?</p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt vel illum fuga unde cum, voluptates magni molestias eveniet culpa autem ut, totam veniam, suscipit tempore ullam pariatur est at asperiores?</p>
    </section>
    <section>
        <?php
        $mystring = 121;
        $mystring2 = 54321;
        //echo strrev($mystring);
        if ($mystring == strrev($mystring2)) {
            echo "is plaindrome";
        }

        $count = strlen($mystring);
        $revstr = '';
        for ($i = ($count - 1); $i >= 0; $i--) {
            $revstr .= $mystring[$i];
        }
        echo $revstr;

        if ($mystring == $revstr) {
            echo "is palindrome";
        }

        $strlength = strlen($mystring);
        $lastchar = substr($mystring, -1);
        //echo "$lastchar$mystring$lastchar";


        /**
         * Number is plaindrome
         *
         * @param [type] $n
         * @return void
         */
        function pal($n)
        {
            $num = $n;
            $sum = 0;
            while (floor($num)) {
                $r = $num % 10;
                $sum = $sum * 10 + $r;
                $num = $num / 10;
            }
            return $sum;
        }
        $mynum = 121;
        $revnum = pal($mynum);
        if ($revnum == $mynum) {
            echo "num is palindrom";
        }

        /**
         * bubble sort
         * 
         */
        $sort = array(3, 5, 7, 2, 5, 8, 1);
        $temp = 0;

        for ($i = 0; $i < count($sort); $i++) {
            for ($j = 0; $j < count($sort) - 1; $j++) {
                if ($sort[$j] > $sort[$j + 1]) {
                    $temp = $sort[$j];
                    $sort[$j] = $sort[$j + 1];
                    $sort[$j + 1] = $temp;
                }
            }
        }
        print_r($sort);

        /**
         * merge sort
         */
        function mergeSort($Array)
        {
            $len = count($Array);
            if ($len == 1) {
                return $Array;
            }
            $mid = (int)$len / 2;
            $left = mergeSort(array_slice($Array, 0, $mid));
            $right = mergeSort(array_slice($Array, $mid));
            return merge($left, $right);
        }

        function merge($left, $right)
        {
            $combined = [];
            $totalLeft = count($left);
            $totalRight = count($right);
            $rightIndex = $leftIndex = 0;
            while ($leftIndex < $totalLeft && $rightIndex < $totalRight) {
                if ($left[$leftIndex] > $right[$rightIndex]) {
                    $combined[] = $right[$rightIndex];
                    $rightIndex++;
                } else {
                    $combined[] = $left[$leftIndex];
                    $leftIndex++;
                }
            }
            while ($leftIndex < $totalLeft) {
                $combined[] = $left[$leftIndex];
                $leftIndex++;
            }
            while ($rightIndex < $totalRight) {
                $combined[] = $right[$rightIndex];
                $rightIndex++;
            }
            return $combined;
        }
        echo "\n";
        print_r(mergeSort(array($sort)));

        /**
         * factorial
         */
        function factorial($x)
        {
            if ($x == 0 || $x == 1)
                return 1;
            else
                return $x * factorial($x - 1);
        }

        echo "10! =  " . factorial(10) . "\n";
        echo "6! =  " . factorial(6) . "\n";

        function asg($n)
        {
            $order = strlen($n);
            $y = $n;
            $sum = 0;

            while ($y > 0) {
                $x = $y % 10;
                $sum = $sum + pow($x, $order);
                $y = (int) ($y / 10);
            }

            if ($n == $sum){
                echo $n." is a Armstrong Number.\n";
              } else {
                echo $n." is not a Armstrong Number.\n";
              }
        }
        echo asg(153);
        ?>
    </section>
</main>

<!--========== MAIN JS ==========-->

<?php include_once(TEMP_PATH_FOOTER); ?>