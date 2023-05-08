function hasEventListener(element, eventName, namespace) {

    var returnValue = false;

    var events = $(element).data("events");

    if (events) {

        $.each(events, function (index, value) {

            if (index == eventName) {

                if (namespace) {

                    $.each(value, function (index, value) {

                        if (value.namespace == namespace) {

                            returnValue = true;

                            return false;

                        }

                    });

                }

                else {

                    returnValue = true;

                    return false;

                }

            }

        });

    }

    return returnValue;

}