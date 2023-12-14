<div>

    <style type="text/css">
        #signatureparent {
            color:darkblue;
            /*max-width:600px;*/
            padding:20px;
        }

        /*This is the div within which the signature canvas is fitted*/
        #signature {
            border: 2px dotted black;
            background-color:lightgrey;
        }

        /* Drawing the 'gripper' for touch-enabled devices */
        html.touch #content {
            float:left;
            width:92%;
        }
        html.touch #scrollgrabber {
            float:right;
            width:4%;
            margin-right:2%;
            background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAFCAAAAACh79lDAAAAAXNSR0IArs4c6QAAABJJREFUCB1jmMmQxjCT4T/DfwAPLgOXlrt3IwAAAABJRU5ErkJggg==)
        }
        html.borderradius #scrollgrabber {
            border-radius: 1em;
        }

    </style>

    <div id="content">
        <div id="signatureparent">
            <div id="{{$attributes['id']}}"></div></div>
        <div id="tools-{{$attributes['id']}}" class="d-flex justify-content-between mt-2"></div>

    </div>
    <div id="scrollgrabber"></div>

    <script src="{{asset('libs/jquery.js')}}"></script>
    <script type="text/javascript">
        jQuery.noConflict()
    </script>
    <script>
        /*  @preserve
        jQuery pub/sub plugin by Peter Higgins (dante@dojotoolkit.org)
        Loosely based on Dojo publish/subscribe API, limited in scope. Rewritten blindly.
        Original is (c) Dojo Foundation 2004-2010. Released under either AFL or new BSD, see:
        http://dojofoundation.org/license for more information.
        */
        (function($) {
            var topics = {};
            $.publish = function(topic, args) {
                if (topics[topic]) {
                    var currentTopic = topics[topic],
                        args = args || {};

                    for (var i = 0, j = currentTopic.length; i < j; i++) {
                        currentTopic[i].call($, args);
                    }
                }
            };
            $.subscribe = function(topic, callback) {
                if (!topics[topic]) {
                    topics[topic] = [];
                }
                topics[topic].push(callback);
                return {
                    "topic": topic,
                    "callback": callback
                };
            };
            $.unsubscribe = function(handle) {
                var topic = handle.topic;
                if (topics[topic]) {
                    var currentTopic = topics[topic];

                    for (var i = 0, j = currentTopic.length; i < j; i++) {
                        if (currentTopic[i] === handle.callback) {
                            currentTopic.splice(i, 1);
                        }
                    }
                }
            };
        })(jQuery);

    </script>
    <script src="{{asset('libs/jSignature.min.noconflict.js')}}"></script>
    <script>
        (function($){

            $(document).ready(function() {


                var $sigdiv = $("#{{$attributes['id']}}").jSignature({'UndoButton':true})

                    // All the code below is just code driving the demo.
                    , $tools = $("#tools-{{$attributes['id']}}")
                    , $extraarea = $('#displayarea')
                    , pubsubprefix = 'jSignature.demo.'

                var export_plugins = $sigdiv.jSignature('listPlugins','export')
                    , chops = ['<span><b>Extract signature data as: </b></span><select>','<option value="">(select export format)</option>']
                    , name
                for(var i in export_plugins){
                    if (export_plugins.hasOwnProperty(i)){
                        name = export_plugins[i]
                        chops.push('<option value="' + name + '">' + name + '</option>')
                    }
                }

                function BtnSave() {
                    $('<input type="button" id="save-{{$attributes['id']}}" class="btn btn-success" value="Salvar">').bind('click', function(e){
                        var data = $sigdiv.jSignature('getData');

                        $.publish(pubsubprefix + 'formatchanged')

                        if (typeof data === 'string'){
                            $('textarea', $tools).val(data)

                            @this.set('{{ $attributes['wire:model'] }}', data)
                            $("#save-{{$attributes['id']}}").remove();

                        } else if($.isArray(data) && data.length === 2){
                            $('textarea', $tools).val(data.join(','))
                            $.publish(pubsubprefix + data[0], data);
                        } else {
                            try {
                                $('textarea', $tools).val(JSON.stringify(data))
                            } catch (ex) {
                                $('textarea', $tools).val('Not sure how to stringify this, likely binary, format.')
                            }
                        }

                    }).appendTo($tools)
                }

                $('<input type="button" class="btn btn-danger" value="Limpar">').bind('click', function(e){
                    $sigdiv.jSignature('reset')
                    @this.set('{{ $attributes['wire:model'] }}', null)
                    $("#save-{{$attributes['id']}}").remove();
                    BtnSave();
                }).appendTo($tools)

                BtnSave();




                $.subscribe(pubsubprefix + 'formatchanged', function(){
                    $extraarea.html('')
                })

                $.subscribe(pubsubprefix + 'image/png;base64', function(data) {

                });
            })

        })(jQuery)
    </script>

</div>
