(function($) {

    class GsCoachMembers extends React.Component {

        static slug = 'gs_coach_members';

        componentDidUpdate() {
            this.triggerScriptProcess();
        }

        triggerScriptProcess() {
            if ( interval ) return;
            let count = 0;
            let interval = setInterval( () => {
                $(document).trigger( 'gscoach:scripts:reprocess' );
                if ( count > 20 ) clearInterval( interval );
                count++;
            }, 100 );
        }
      
        render() {
            return <div className='gs-coach-members' dangerouslySetInnerHTML={{ __html: this.props.__shortcode }}></div>
        }
    }

    $(window).on('et_builder_api_ready', (event, API) => {
        API.registerModules([GsCoachMembers]);
    });

})(jQuery);