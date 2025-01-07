(function($) {

    var GS_Coach_Member = function( $scope, $ ) {

        var $teamWidget = $scope.find('.gs_coach_area');

        if ( ! $teamWidget.length ) return;

        $(document).trigger( 'gscoach:scripts:reprocess' );

    }

    $(window).on( 'elementor/frontend/init', function() {

        elementorFrontend.hooks.addAction( 'frontend/element_ready/gs-coach-members.default', GS_Coach_Member );

    });

})(jQuery);