<!DOCTYPE html>
<html>
<head>
<style>

    * {
        top:0;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 0;
        margin: 0;
        /* border: 2px solid red; */
    }

    body {
        top:0;
        bottom:0;
        left:0;
        right:0;
        margin: 30px 30px;
        /* background-color: aqua; */
    }

    div.container {
        width:100%;
        height: 100%;
        /* top: 50px; */
        /* margin:15px; */
        /* border: 2px solid red; */
    }

    div.inner {
        background-color: white;
        /* top: 35px; */
        padding: 0px 5px;
        /* margin: 18px; */
        overflow: hidden;
    }

    table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size:15.5px;
        }

        table td {
            border: 1px solid #000;
            padding-left : 10px;
            padding-top: 8px;
            padding-bottom: 5px;
            text-align: left;
            min-height: 46px;
        }

        table th {
            border: 1px solid #000;
            font-size:16px;
            text-align: left;
            background-color: #f2f2f2;
            overflow: hidden;
            padding-left : 8px;
            padding-right : 2px;
            padding-top: 8px;
            padding-bottom: 6px;
        }

</style>
</head>
<body>

    <div class="container">
        <div class="inner">
        <table class="text-center">
            @foreach ($paginatedData as $pageData)
                <tr>
                    <th>S. NO.</th>
                    <th>SC BAKING PLATES REF. NO.</th>
                    <th>FMSI NO.</th>
                    <th class="p-4" style="border:none; width:20px; background-color:white;"></th>
                    <th>S. NO.</th>
                    <th>SC BAKING PLATES REF. NO.</th>
                    <th>FMSI NO.</th>
                </tr>

                @for ($i = 0; $i < max(count($pageData['leftHalf']), count($pageData['rightHalf'])); $i++)
                <tr>
                    <td width='7%'>{{ $pageData['startIndex'] + $i + 1 }}</td>
                    <td width="20%">{{ isset($pageData['leftHalf'][$i]) ? $pageData['leftHalf'][$i]['product_id'] : '' }}</td>
                    <?php
$arr = explode(',', $pageData['leftHalf'][$i]['fmsi_number']);
$count = count($arr);
?>
                    @if($count>2)
                        <td width="20%" style="font-size: 13px; padding-left : 6px;
                            padding-top: 2px;
                            padding-bottom: 1px; ">

                            @foreach($arr as $a)
                                {{$a}},
                            @endforeach
                        </td>

                    @else
                        <td width="20%" style="padding-left : 10px;
                            padding-top: 8px;padding-bottom: 6px;">
                            {{ isset($pageData['leftHalf'][$i]) ? $pageData['leftHalf'][$i]['fmsi_number'] : '' }}
                        </td>

                    @endif


                    <td  width="2%" style="border:none; background-color:white;"></td>
                    @if(isset($pageData['rightHalf'][$i]))
                        <td width="7%">{{ $pageData['startIndex'] + $i + $pageData['halfCount'] + 1 }}</td>
                        <td width="20%">{{ isset($pageData['rightHalf'][$i]) ? $pageData['rightHalf'][$i]['product_id'] : '' }}</td>
                        <?php
$arrr = explode(',', $pageData['rightHalf'][$i]['fmsi_number']);
$countr = count($arrr);
?>
                        @if($countr>2)
                            <td width="25%" style="font-size: 13px;padding-left : 6px;padding-top: 2px;
                                padding-bottom: 1px;">

                                @foreach($arrr as $a)
                                    {{$a}},
                                @endforeach
                            </td>

                        @else
                            <td width="25%" style="padding-left : 10px;
                                padding-top: 8px;
                                padding-bottom: 6px;">
                                {{ isset($pageData['rightHalf'][$i]) ? $pageData['rightHalf'][$i]['fmsi_number'] : '' }}
                            </td>

                        @endif
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif

                </tr>
                @endfor

        {{-- Page break for the PDF rendering --}}
        <!--
        <div style="page-break-after: always; page-break-inside: avoid;"></div>
    -->
    @endforeach
    </table>

        </div>
    </div>
    <footer>

    </footer>

</body>
</html>