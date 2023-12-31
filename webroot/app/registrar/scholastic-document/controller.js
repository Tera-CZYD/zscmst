app.controller("ScholasticDocumentController", function ($scope, $window, ScholasticDocument) {

  $scope.today = Date.parse("today").toString("MM/dd/yyyy");

  $(".datepicker").datepicker({
    format: "mm/dd/yyyy",

    autoclose: true,

    todayHighlight: true,
  });

  $scope.load = function (options) {
    options = typeof options !== "undefined" ? options : {};

    ScholasticDocument.query(options, function (e) {
      if (e.ok) {
        $scope.datas = e.data;

        $scope.conditionsPrint = e.conditionsPrint;

        $scope.paginator = e.paginator;

        $scope.pages = paginator($scope.paginator, 5);
      }
    });
  };

  $scope.scrollToTop = function() {

    $window.scrollTo(0, 0);

  };

  $scope.scrollToTop();

  $scope.load();

  $scope.reload = function (options) {
    $scope.search = {};

    $scope.searchTxt = "";

    $scope.dateToday = null;

    $scope.startDate = null;

    $scope.endDate = null;

    $scope.load();
  };

  $scope.searchy = function (search) {
    search = typeof search !== "undefined" ? search : "";

    if (search.length > 0) {
      $scope.load({
        search: search,
      });
    } else {
      $scope.load();
    }
  };

  $scope.advance_search = function () {
    $scope.search = {};

    $scope.advanceSearch = false;

    $scope.position_id = null;

    $scope.office_id = null;

    $(".monthpicker").datepicker({
      format: "MM",

      autoclose: true,

      minViewMode: "months",

      maxViewMode: "months",
    });

    $(".input-daterange").datepicker({
      format: "yyyy-mm-dd",
    });

    $(".datepicker").datepicker("setDate", "");

    $(".monthpicker").datepicker("setDate", "");

    $(".input-daterange").datepicker("setDate", "");

    $("#advance-search-modal").modal("show");
  };

  $scope.searchFilter = function (search) {
    $scope.filter = false;

    $scope.advanceSearch = true;

    $scope.searchTxt = "";

    $scope.dateToday = null;

    $scope.startDate = null;

    $scope.endDate = null;

    if (search.filterBy == "today") {
      $scope.dateToday = Date.parse("today").toString("yyyy-MM-dd");

      $scope.today = Date.parse("today").toString("yyyy-MM-dd");

      $scope.dateToday = $scope.today;

      $scope.load({
        date: $scope.dateToday,
      });
    } else if (search.filterBy == "date") {
      $scope.dateToday = Date.parse(search.date).toString("yyyy-MM-dd");

      $scope.load({
        date: $scope.dateToday,
      });
    } else if (search.filterBy == "month") {
      date = $(".monthpicker").datepicker("getDate");

      year = date.getFullYear();

      month = date.getMonth() + 1;

      lastDay = new Date(year, month, 0);

      if (month < 10) month = "0" + month;

      $scope.startDate = year + "-" + month + "-01";

      $scope.endDate = year + "-" + month + "-" + lastDay.getDate();

      $scope.load({
        startDate: $scope.startDate,

        endDate: $scope.endDate,
      });
    } else if (search.filterBy == "this-month") {
      date = new Date();

      year = date.getFullYear();

      month = date.getMonth() + 1;

      lastDay = new Date(year, month, 0);

      if (month < 10) month = "0" + month;

      $scope.startDate = year + "-" + month + "-01";

      $scope.endDate = year + "-" + month + "-" + lastDay.getDate();

      $scope.load({
        startDate: $scope.startDate,

        endDate: $scope.endDate,
      });
    } else if (search.filterBy == "custom") {
      $scope.startDate = Date.parse(search.startDate).toString("yyyy-MM-dd");

      $scope.endDate = Date.parse(search.endDate).toString("yyyy-MM-dd");
    }

    $scope.load({
      date: $scope.dateToday,

      startDate: $scope.startDate,

      endDate: $scope.endDate,
    });

    $("#advance-search-modal").modal("hide");
  };

  $scope.remove = function (data) {
    bootbox.confirm(
      "Are you sure you want to delete " + data.code +  " ?",
      function (c) {
        if (c) {
          ScholasticDocument.remove({ id: data.id }, function (e) {
            if (e.ok) {
              $.gritter.add({
                title: "Successful!",

                text: e.msg,
              });

              $scope.load();
            }
          });
        }
      }
    );
  };

  $scope.print = function () {
    date = "";

    if ($scope.conditionsPrint !== "") {
      printTable(base + "print/scholastic_document?print=1" + $scope.conditionsPrint);
    } else {
      printTable(base + "print/scholastic_document?print=1");
    }
  };
});

app.controller( "ScholasticDocumentAddController", function ($scope, ScholasticDocument, Select) {

  $("#form").validationEngine("attach");

  $(".datepicker").datepicker({

    format: "mm/dd/yyyy",

    autoclose: true,

    todayHighlight: true,

  });

  $(".clockpicker").clockpicker({

    donetext: "Done",

    twelvehour: true,

    placement: "bottom",

  });

  $scope.data = {

    ScholasticDocument: {},

  };

    $scope.save = function () {

      valid = $("#form").validationEngine("validate");

      if (valid) {

        ScholasticDocument.save($scope.data, function (e) {

          if (e.ok) {

            $.gritter.add({

              title: "Successful!",


              text: e.msg,

            });

            window.location = "#/registrar/scholastic-document";

          } else {

            $.gritter.add({

              title: "Warning!",

              text: e.msg,

            });

          }

          console.log(e.msg);

        });

      }

    };

  }

);

app.controller( "ScholasticDocumentViewController", function ($scope, $routeParams, ScholasticDocument) {
    $scope.id = $routeParams.id;

    $scope.data = {};

    // load

    $scope.load = function () {

      ScholasticDocument.get({ id: $scope.id }, function (e) {

        $scope.data = e.data;

      });

    };

    $scope.load();

    $scope.print = function (id) {

      printTable(base + "print/scholastic_document_form/" + id);

    };

    // remove
    $scope.remove = function (data) {

      bootbox.confirm(

        "Are you sure you want to remove " + data.code + " ?",

        function (c) {

          if (c) {

            ScholasticDocument.remove({ id: data.id }, function (e) {

              if (e.ok) {

                $.gritter.add({

                  title: "Successful!",

                  text: e.msg,

                });

                window.location = "#/registrar/scholastic-form";
              }
            });
          }
        }
      );
    };
  }
);

app.controller(
  "ScholasticDocumentEditController",
  function ($scope, $routeParams, ScholasticDocument, Select) {
    $scope.id = $routeParams.id;

    $("#form").validationEngine("attach");

    $(".datepicker").datepicker({
      format: "mm/dd/yyyy",

      autoclose: true,

      todayHighlight: true,
    });

    $(".clockpicker").clockpicker({
      donetext: "Done",

      twelvehour: true,

      placement: "bottom",
    });

    $scope.data = {
      ScholasticDocument: {},
    };

    // load

    $scope.load = function () {
      ScholasticDocument.get({ id: $scope.id }, function (e) {
        $scope.data = e.data;
      });
    };
    $scope.load();



    $scope.update = function () {
      valid = $("#form").validationEngine("validate");

      if (valid) {
        ScholasticDocument.update({ id: $scope.id }, $scope.data, function (e) {
          if (e.ok) {
            $.gritter.add({
              title: "Successful!",

              text: e.msg,
            });

            window.location = "#/registrar/scholastic-document";
          } else {
            $.gritter.add({
              title: "Warning!",

              text: e.msg,
            });
          }
        });
      }
    };
  }
);
