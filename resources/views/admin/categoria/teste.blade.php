<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hierarchy Select jQuery Plugin for Twitter Bootstrap</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('js/scripts/forms/hierarchy-select/hierarchy-select.min.css') }}">
</head>
<body>

    <form>
        <div class="form-group">
        <div class="btn-group hierarchy-select" data-resize="auto" id="your-expertise-hierarchy">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <span class="selected-label pull-left"> </span>
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu open">
            <div class="hs-searchbox">
                <input type="text" class="form-control" autocomplete="off">
            </div>
            <ul class="dropdown-menu inner" role="menu">
                <li data-value="" data-level="1" class="level-1 active">
                    <a href="#">Your Expertise</a>
                </li>
                <li data-value="1" data-level="1" class="level-1">
                    <a href="#">Web</a>
                </li>
                <li data-value="2" data-level="2" class="level-2">
                    <a href="#">Scripting</a>
                </li>
                <li data-value="3" data-level="3" class="level-3">
                    <a href="#">PHP</a>
                </li>
                <li data-value="4" data-level="3" class="level-3">
                    <a href="#">JavaScript</a>
                </li>
                <li data-value="5" data-level="3" class="level-3">
                    <a href="#">.Net</a>
                </li>
                <li data-value="5" data-level="3" class="level-3">
                    <a href="#">JSP</a>
                </li>
                <li data-value="6" data-level="2" class="level-2">
                    <a href="#">Framework</a>
                </li>
                <li data-value="7" data-level="3" class="level-3">
                    <a href="#">Bootstrap</a>
                </li>
                <li data-value="9" data-level="1" class="level-1">
                    <a href="#">Database</a>
                </li>
                <li data-value="10" data-level="2" class="level-2">
                    <a href="#">MySQL</a>
                </li>
                <li data-value="11" data-level="2" class="level-2">
                    <a href="#">MS SQL Server</a>
                </li>
                <li data-value="12" data-level="2" class="level-2">
                    <a href="#">Oracle</a>
                </li>
                <li data-value="13" data-level="1" class="level-1">
                    <a href="#">Programming</a>
                </li>
                <li data-value="14" data-level="2" class="level-2">
                    <a href="#">Java</a>
                </li>
                <li data-value="15" data-level="2" class="level-2">
                    <a href="#">Python</a>
                </li>
                <li data-value="16" data-level="2" class="level-2">
                    <a href="#">C Sharp</a>
                </li>
            </ul>
        </div>
        <input class="hidden hidden-field" name="search_form[category]" readonly aria-hidden="true" type="text"/>
        </div>
        </div>
        </form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts/forms/hierarchy-select/hierarchy-select.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#your-expertise-hierarchy').hierarchySelect({
                hierarchy: true,
                search: true,
                width: 250
            });
        });
    </script>
</body>
</html>
