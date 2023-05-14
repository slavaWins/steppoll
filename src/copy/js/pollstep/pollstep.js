var StepPoll = {};

StepPoll.step = 0;

StepPoll.RenderStep = function () {
    $('.alertPoll').hide();
    $('.btnNextStep').show();
    $('.stepNumber').text(StepPoll.step + 1);
    $('.stepPoll').hide();
    $('.stepPoll_' + StepPoll.step).show();
}

StepPoll.Init = function () {
    StepPoll.stepCount = parseInt($('.stepCount').text());
}


StepPoll.GetFormDataCurrentStep = function () {
    var data = {};
    var formData = $('.stepPoll_' + StepPoll.step).serializeArray();
    for (var i = 0; i < formData.length; i++) {
        data[formData[i].name] = formData[i].value;
    }
    return data;
}



StepPoll.GetFormDataAllSteps = function () {
    var data = {};

    for (var s = 0; s < StepPoll.stepCount; s++) {
        var formData = $('.stepPoll_' + s).serializeArray();
        for (var i = 0; i < formData.length; i++) {
            data[formData[i].name] = formData[i].value;
        }
    }
    return data;
}


StepPoll.NextStep = function () {
    $('.alertPoll').hide();
    $('.btnNextStep').hide();


    var pollId = $('.pollId').attr('pollId');
    var data = StepPoll.GetFormDataCurrentStep();
    data.myStepNumber = StepPoll.step;


    var url = '/poll/validate/' + pollId;



    EasyApi.Post(url, data, function (response, error) {
        if (error) {
            StepPoll.RenderStep();
            $('.alertPoll').show();
            $('.alertPoll').html(error);
            return;
        }


        if (StepPoll.step == StepPoll.stepCount - 1) {
            console.log("LAST STEP");

            $('#formFinal').hide();
            $('#formFinal').append($('.stepPollContainer input'));
            $('#formFinal').append($('.stepPollContainer select'));
            $('#formFinal').append($('.stepPollContainer checkbox'));
            $('#formFinal').append($('.stepPollContainer radio'));
            $('#formFinal').submit();
            return;
        }

        StepPoll.step += 1;
        StepPoll.RenderStep();
    });
}

$(document).ready(function () {
    StepPoll.Init();
});

window.StepPoll = StepPoll;
