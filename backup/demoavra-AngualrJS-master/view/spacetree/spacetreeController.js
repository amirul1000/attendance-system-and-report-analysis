'use strict';

deskControllers.controller('spacetreeController', ['$scope', '$window', '$cookies','recalculate',
    function ($scope, $window, $cookies, recalculate) {

        var userData = $cookies.getObject('userData');

        $scope.userName = userData.USER_NAME
        console.log(JSON.stringify($scope.userName));
        $scope.defects = 0;
        $scope.detectedTime = 0;

        var labelType, useGradients, nativeTextSupport, animate;

        var plus14days = new Date();
        plus14days.setDate(plus14days.getDate() - 7);
        $(".datepicker").datepicker("setDate", plus14days);
        var a = $(".datepicker").datepicker('update');

        var i = new Date();
        i.setDate(i.getDate() + 0);
        $(".datepicker1").datepicker("setDate", i);
        $(".datepicker1").datepicker('update');

        var startDate = "";
        var endDate = "";

        initFunction();

        $("#startDate").change(function () {
            initFunction();
        });

        $("#endDate").change(function () {
            initFunction();
        });


        $scope.recalculate = function(){

            $(".node").css('background','lightblue');
            $(".node").css('width','80');
            //$window.location.reload();
            recalculate.get({STR_DATE:startDate, END_DATE:endDate, DEFECTS:$scope.defects, DETECTED_HOURS:$scope.detectedTime, SAP_LEVEL:$scope.sapactivitylevel},function(response){
                //console.log(JSON.stringify(response.data.USER_INFROMATION));

                if(response.data.USER_INFROMATION){
                    angular.forEach(response.data.USER_INFROMATION,function(value, key){
                        var flag = $("#node0"+value.UC_USER_ID);

                        flag.css('background','#337AB7');
                        flag.css('width','80');
                    });
                }
                else{
                    $.toaster("No Data Found", 'Alert', 'warning');
                }


            },function(){
                $.toaster("Connaction Problem", 'Alert', 'danger');
            });


        }

        function initFunction() {

            $("#infovis").empty();
            //init data
            $(".loader").fadeOut();

            startDate = $("#startDate").val();
            endDate = $("#endDate").val();

            //console.log("Start : "+startDate);

            var json = {
                id: "node00",
                name: "john",
                data: {},
                children: [{
                    id: "node13",
                    name: "ABAP - SD",
                    data: { href: "#bar?STR_DATE="+startDate+"&END_DATE="+endDate+""},
                    children: [{
                        id: "node01",
                        name: "MolineuxP",
                        data: { href: "#information?USER_NAME=MolineuxP&USER_ID=1&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                    }, {
                        id: "node02",
                        name: " PannettA",
                        data: { href: "#information?USER_NAME=PannettA&USER_ID=2&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node323",
                            name: "3.23",
                            data: {},
                            children: [{
                                id: "node424",
                                name: "4.24",
                                data: {},
                                children: []
                            }]
                        }]
                    }]
                }, {
                    id: "node125",
                    name: " ABAP - MM",
                    data: { href: "#bar?STR_DATE="+startDate+"&END_DATE="+endDate+""},
                    children: [{
                        id: "node03",
                        name: " OscarM",
                        data: { href: "#information?USER_NAME=OscarM&USER_ID=3&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node327",
                            name: "3.27",
                            data: { href: "#information?USER_NAME=OscarM&USER_ID=3&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                            children: [{
                                id: "node428",
                                name: "4.28",
                                data: {},
                                children: []
                            }, {
                                id: "node429",
                                name: "4.29",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node330",
                            name: "3.30",
                            data: {},
                            children: [{
                                id: "node431",
                                name: "4.31",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node332",
                            name: "3.32",
                            data: {},
                            children: [{
                                id: "node433",
                                name: "4.33",
                                data: {},
                                children: []
                            }, {
                                id: "node434",
                                name: "4.34",
                                data: {},
                                children: []
                            }, {
                                id: "node435",
                                name: "4.35",
                                data: {},
                                children: []
                            }, {
                                id: "node436",
                                name: "4.36",
                                data: {},
                                children: []
                            }]
                        }]
                    }, {
                        id: "node04",
                        name: "julietteM",
                        data: { href: "#information?USER_NAME=julietteM&USER_ID=4&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node338",
                            name: "3.38",
                            data: {},
                            children: [{
                                id: "node439",
                                name: "4.39",
                                data: {},
                                children: []
                            }, {
                                id: "node440",
                                name: "4.40",
                                data: {},
                                children: []
                            }, {
                                id: "node441",
                                name: "4.41",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node342",
                            name: "3.42",
                            data: {},
                            children: [{
                                id: "node443",
                                name: "4.43",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node344",
                            name: "3.44",
                            data: {},
                            children: [{
                                id: "node445",
                                name: "4.45",
                                data: {},
                                children: []
                            }, {
                                id: "node446",
                                name: "4.46",
                                data: {},
                                children: []
                            }, {
                                id: "node447",
                                name: "4.47",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node348",
                            name: "3.48",
                            data: {},
                            children: [{
                                id: "node449",
                                name: "4.49",
                                data: {},
                                children: []
                            }, {
                                id: "node450",
                                name: "4.50",
                                data: {},
                                children: []
                            }, {
                                id: "node451",
                                name: "4.51",
                                data: {},
                                children: []
                            }, {
                                id: "node452",
                                name: "4.52",
                                data: {},
                                children: []
                            }, {
                                id: "node453",
                                name: "4.53",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node354",
                            name: "3.54",
                            data: {},
                            children: [{
                                id: "node455",
                                name: "4.55",
                                data: {},
                                children: []
                            }, {
                                id: "node456",
                                name: "4.56",
                                data: {},
                                children: []
                            }, {
                                id: "node457",
                                name: "4.57",
                                data: {},
                                children: []
                            }]
                        }]
                    }, {
                        id: "node05",
                        name: "AugustM",
                        data: { href: "#information?USER_NAME=AugustM&USER_ID=5&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node359",
                            name: "3.59",
                            data: {},
                            children: [{
                                id: "node460",
                                name: "4.60",
                                data: {},
                                children: []
                            }, {
                                id: "node461",
                                name: "4.61",
                                data: {},
                                children: []
                            }, {
                                id: "node462",
                                name: "4.62",
                                data: {},
                                children: []
                            }, {
                                id: "node463",
                                name: "4.63",
                                data: {},
                                children: []
                            }, {
                                id: "node464",
                                name: "4.64",
                                data: {},
                                children: []
                            }]
                        }]
                    }]
                }, {
                    id: "node165",
                    name: "CRM",
                    data: { href: "#bar?STR_DATE="+startDate+"&END_DATE="+endDate+""},
                    children: [{
                        id: "node06",
                        name: "MaxM",
                        data: { href: "#information?USER_NAME=MaxM&USER_ID=6&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node367",
                            name: "3.67",
                            data: {},
                            children: [{
                                id: "node468",
                                name: "4.68",
                                data: {},
                                children: []
                            }, {
                                id: "node469",
                                name: "4.69",
                                data: {},
                                children: []
                            }, {
                                id: "node470",
                                name: "4.70",
                                data: {},
                                children: []
                            }, {
                                id: "node471",
                                name: "4.71",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node372",
                            name: "3.72",
                            data: {},
                            children: [{
                                id: "node473",
                                name: "4.73",
                                data: {},
                                children: []
                            }, {
                                id: "node474",
                                name: "4.74",
                                data: {},
                                children: []
                            }, {
                                id: "node475",
                                name: "4.75",
                                data: {},
                                children: []
                            }, {
                                id: "node476",
                                name: "4.76",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node377",
                            name: "3.77",
                            data: {},
                            children: [{
                                id: "node478",
                                name: "4.78",
                                data: {},
                                children: []
                            }, {
                                id: "node479",
                                name: "4.79",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node380",
                            name: "3.80",
                            data: {},
                            children: [{
                                id: "node481",
                                name: "4.81",
                                data: {},
                                children: []
                            }, {
                                id: "node482",
                                name: "4.82",
                                data: {},
                                children: []
                            }]
                        }]
                    }, {
                        id: "node07",
                        name: " JamesM",
                        data: { href: "#information?USER_NAME=JamesM&USER_ID=7&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node384",
                            name: "3.84",
                            data: {},
                            children: [{
                                id: "node485",
                                name: "4.85",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node386",
                            name: "3.86",
                            data: {},
                            children: [{
                                id: "node487",
                                name: "4.87",
                                data: {},
                                children: []
                            }, {
                                id: "node488",
                                name: "4.88",
                                data: {},
                                children: []
                            }, {
                                id: "node489",
                                name: "4.89",
                                data: {},
                                children: []
                            }, {
                                id: "node490",
                                name: "4.90",
                                data: {},
                                children: []
                            }, {
                                id: "node491",
                                name: "4.91",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node392",
                            name: "3.92",
                            data: {},
                            children: [{
                                id: "node493",
                                name: "4.93",
                                data: {},
                                children: []
                            }, {
                                id: "node494",
                                name: "4.94",
                                data: {},
                                children: []
                            }, {
                                id: "node495",
                                name: "4.95",
                                data: {},
                                children: []
                            }, {
                                id: "node496",
                                name: "4.96",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node397",
                            name: "3.97",
                            data: {},
                            children: [{
                                id: "node498",
                                name: "4.98",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node399",
                            name: "3.99",
                            data: {},
                            children: [{
                                id: "node4100",
                                name: "4.100",
                                data: {},
                                children: []
                            }, {
                                id: "node4101",
                                name: "4.101",
                                data: {},
                                children: []
                            }, {
                                id: "node4102",
                                name: "4.102",
                                data: {},
                                children: []
                            }, {
                                id: "node4103",
                                name: "4.103",
                                data: {},
                                children: []
                            }]
                        }]
                    }, {
                        id: "node08",
                        name: " ChrisssyM",
                        data: { href: "#information?USER_NAME=ChrisssyM&USER_ID=8&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node3105",
                            name: "3.105",
                            data: {},
                            children: [{
                                id: "node4106",
                                name: "4.106",
                                data: {},
                                children: []
                            }, {
                                id: "node4107",
                                name: "4.107",
                                data: {},
                                children: []
                            }, {
                                id: "node4108",
                                name: "4.108",
                                data: {},
                                children: []
                            }]
                        }]
                    }, {
                        id: "node09",
                        name: "Charlesm",
                        data: { href: "#information?USER_NAME=Charlesm&USER_ID=9&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node3110",
                            name: "3.110",
                            data: {},
                            children: [{
                                id: "node4111",
                                name: "4.111",
                                data: {},
                                children: []
                            }, {
                                id: "node4112",
                                name: "4.112",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node3113",
                            name: "3.113",
                            data: {},
                            children: [{
                                id: "node4114",
                                name: "4.114",
                                data: {},
                                children: []
                            }, {
                                id: "node4115",
                                name: "4.115",
                                data: {},
                                children: []
                            }, {
                                id: "node4116",
                                name: "4.116",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node3117",
                            name: "3.117",
                            data: {},
                            children: [{
                                id: "node4118",
                                name: "4.118",
                                data: {},
                                children: []
                            }, {
                                id: "node4119",
                                name: "4.119",
                                data: {},
                                children: []
                            }, {
                                id: "node4120",
                                name: "4.120",
                                data: {},
                                children: []
                            }, {
                                id: "node4121",
                                name: "4.121",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node3122",
                            name: "3.122",
                            data: {},
                            children: [{
                                id: "node4123",
                                name: "4.123",
                                data: {},
                                children: []
                            }, {
                                id: "node4124",
                                name: "4.124",
                                data: {},
                                children: []
                            }]
                        }]
                    }, {
                        id: "node2125",
                        name: "Harris",
                        data: { href: "#information?USER_NAME=Harris&USER_ID=10&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node3126",
                            name: "3.126",
                            data: {},
                            children: [{
                                id: "node4127",
                                name: "4.127",
                                data: {},
                                children: []
                            }, {
                                id: "node4128",
                                name: "4.128",
                                data: {},
                                children: []
                            }, {
                                id: "node4129",
                                name: "4.129",
                                data: {},
                                children: []
                            }]
                        }]
                    }]
                }, {
                    id: "node1130",
                    name: "SRM",
                    data: { href: "#bar?STR_DATE="+startDate+"&END_DATE="+endDate+""},
                    children: [{
                        id: "node2131",
                        name: " Clark",
                        data: { href: "#information?USER_NAME=Clark&USER_ID=11&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node3132",
                            name: "3.132",
                            data: {},
                            children: [{
                                id: "node4133",
                                name: "4.133",
                                data: {},
                                children: []
                            }, {
                                id: "node4134",
                                name: "4.134",
                                data: {},
                                children: []
                            }, {
                                id: "node4135",
                                name: "4.135",
                                data: {},
                                children: []
                            }, {
                                id: "node4136",
                                name: "4.136",
                                data: {},
                                children: []
                            }, {
                                id: "node4137",
                                name: "4.137",
                                data: {},
                                children: []
                            }]
                        }]
                    }, {
                        id: "node2138",
                        name: "Lee",
                        data: { href: "#information?USER_NAME=Lee&USER_ID=12&STR_DATE="+startDate+"&END_DATE="+endDate+""},
                        children: [{
                            id: "node3139",
                            name: "3.139",
                            data: {},
                            children: [{
                                id: "node4140",
                                name: "4.140",
                                data: {},
                                children: []
                            }, {
                                id: "node4141",
                                name: "4.141",
                                data: {},
                                children: []
                            }]
                        }, {
                            id: "node3142",
                            name: "3.142",
                            data: {},
                            children: [{
                                id: "node4143",
                                name: "4.143",
                                data: {},
                                children: []
                            }, {
                                id: "node4144",
                                name: "4.144",
                                data: {},
                                children: []
                            }, {
                                id: "node4145",
                                name: "4.145",
                                data: {},
                                children: []
                            }, {
                                id: "node4146",
                                name: "4.146",
                                data: {},
                                children: []
                            }, {
                                id: "node4147",
                                name: "4.147",
                                data: {},
                                children: []
                            }]
                        }]
                    }]
                }]
            };

            //end
            //init Spacetree
            //Create a new ST instance
            var st = new $jit.ST({
                //id of viz container element
                injectInto: 'infovis',
                //set duration for the animation
                duration: 500,
                //set animation transition type
                transition: $jit.Trans.Quart.easeInOut,
                //set distance between node and its children
                levelDistance: 40,
                //enable panning
                Navigation: {
                    enable: true,
                    panning: true
                },
                //set node and edge styles
                //set overridable=true for styling individual
                //nodes or edges
                Node: {
                    height: 25,
                    width: 80,
                    type: 'rectangle',
                    color: '#1A82BF',
                    overridable: true
                },

                Edge: {
                    type: 'bezier',
                    overridable: true
                },

                /* onBeforeCompute: function (node) {
                 Log.write("loading " + node.name);
                 },

                 onAfterCompute: function () {
                 Log.write("done");
                 },*/

                //This method is called on DOM label creation.
                //Use this method to add event handlers and styles to
                //your node.
                onCreateLabel: function (label, node) {
                    label.id = node.id;
                    label.innerHTML = node.name;
                    label.onclick = function () {
                        if (left.checked) {
                            //var pre = node.id.indexOf("e");
                            var pre = node.id.substring(4, 6);
                            console.log("pre : "+pre);
                            if (pre > 0) {

                                window.location.href = node.data.href;

                            }
                        }
                        else if (top.checked) {
                            //var pre = node.id.indexOf("e");
                            var pre = node.id.substring(4, 5);
                            if (pre == 1) {
                                window.location.href = node.data.href;
                            }
                        }
                        else if (normal.checked) {

                        }
                        else {
                            st.setRoot(node.id, 'animate');
                        }
                    };
                    //set label styles
                    var style = label.style;
                    style.cursor = 'pointer';
                    style.color = 'white';
                    style.fontSize = '15px';
                    style.textAlign = 'center';
                    style.padding = '1px';
                },

                //This method is called right before plotting
                //a node. It's useful for changing an individual node
                //style properties before plotting it.
                //The data properties prefixed with a dollar
                //sign will override the global node style properties.
                onBeforePlotNode: function (node) {
                    //add some color to the nodes in the path between the
                    //root node and the selected node.
                    if (node.selected) {
                        node.data.$color = "#0E4061";
                    }
                    else {
                        delete node.data.$color;
                        //if the node belongs to the last plotted level
                        if (!node.anySubnode("exist")) {
                            //count children number
                            var count = 0;
                            node.eachSubnode(function (n) {
                                count++;
                            });
                            //assign a node color based on
                            //how many children it has
                            node.data.$color = ['lightblue', 'lightblue', 'lightblue', 'lightblue', 'lightblue', 'lightblue'][count];
                        }
                    }
                },

                //This method is called right before plotting
                //an edge. It's useful for changing an individual edge
                //style properties before plotting it.
                //Edge data proprties prefixed with a dollar sign will
                //override the Edge global style properties.
                onBeforePlotLine: function (adj) {
                    if (adj.nodeFrom.selected && adj.nodeTo.selected) {
                        adj.data.$color = "#eed";
                        adj.data.$lineWidth = 3;
                    }
                    else {
                        delete adj.data.$color;
                        delete adj.data.$lineWidth;
                    }
                }
            });
            //load json data
            st.loadJSON(json);
            //compute node positions and layout
            st.compute();
            //optional: make a translation of the tree
            st.geom.translate(new $jit.Complex(-200, 0), "current");
            //emulate a click on the root node.
            st.onClick(st.root);
            //end
            //Add event handlers to switch spacetree orientation.
            var top = $jit.id('r-top'),
                left = $jit.id('r-left'),

                normal = $jit.id('s-normal');


            function changeHandler() {
                if (this.checked) {
                    top.disabled = left.disabled = true;
                    st.switchPosition(this.value, "animate", {
                        onComplete: function () {
                            top.disabled =  left.disabled = false;
                        }
                    });
                }
            };

            top.onchange = left.onchange =changeHandler;
            //end

        }

    }]);
