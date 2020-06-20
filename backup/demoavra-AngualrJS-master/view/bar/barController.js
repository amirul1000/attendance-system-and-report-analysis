'use strict';

deskControllers.controller('barController', ['$scope','$window', '$location', 'teamperfrom', '$rootScope',
      function($scope, $window, $location, teamperfrom, $rootScope){
          $(".loader").fadeOut();

          var searchObject = $location.search();
          $scope.STR_DATE = searchObject.STR_DATE;
          $scope.END_DATE = searchObject.END_DATE;

          $scope.categorys = [];
          $scope.defect = [];
          $scope.sap = [];
          $scope.attandance = [3, 2, 3, 4, 5, 6, 6, 7, 5];

          $scope.chartData = [];

          teamperfrom.get(
              {
                  STR_DATE: $scope.STR_DATE,
                  END_DATE: $scope.END_DATE
              }, function (response) {
                  $(".loader").fadeIn();
                  //console.log('Get Data : ' +JSON.stringify(response));
                  if(response.status == 1){
                      $(".loader").fadeOut();
                      angular.forEach(response.data.DEFFECTS, function(value, key){
                          $scope.defect.push(value.D_USER_POINT);
                          $scope.categorys.push(value.D_USER_ID);
                      });
                      angular.forEach(response.data.SAP_ACTIVITY_LOG, function(value, key){
                          //$scope.sap.push(value.SAP_USER_ID);
                          $scope.sap.push(value.SAP_USER_POINT);
                      })

                      $scope.chartData = [{
                          name: 'Defect Resolution ',
                          data: $scope.defect
                      }, {
                          name: 'Technical Activity',
                          data: $scope.sap
                      },{
                          name: 'Attendance',
                          data: $scope.attandance
                      }]

                      $rootScope.$broadcast('changeData', {});

                      /*console.log("categorys : "+JSON.stringify($scope.categorys));
                      console.log("chartData : "+JSON.stringify($scope.chartData));*/
                  }
                  else{
                      $(".loader").fadeOut();
                      $scope.msg = "Not Data Avialable...";
                      $.toaster(response.msg, 'Alert', 'warning');
                  }
          },function(){
                  $.toaster("Connection Problem ", 'Alert', 'danger');
          });

}]);
