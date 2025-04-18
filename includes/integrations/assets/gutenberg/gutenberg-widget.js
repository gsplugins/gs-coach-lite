( function( wp, React, $ ) {

    const { data, blocks, serverSideRender: ServerSideRender } = wp;
    const { __ } = wp.i18n;
    const { registerBlockType } = blocks;
    const { withSelect } = data;

    var interval, interval_count = 0;

    const BlockServerRenderScript = function() {

        if ( interval ) clearInterval( interval );

        interval_count = 0;

        interval = setInterval(function() {
            
            $(document).trigger( 'gscoach:scripts:reprocess' );
            if ( interval && interval_count > 100 ) clearInterval( interval );
            interval_count ++;

        }, 200);

    }

    const BlockDisplay = function({ setAttributes, attributes, className }) {

        let shortcodeID = attributes.shortcode;

        function updateShortcodeID( event ) {

            setAttributes({
                shortcode: event.target.value
            });

        }

        function getShortcodeOptions() {

            return gs_coach_block.gs_coach_shortcodes.map(function( item ) {
                return <option value={item.id} key={item.id}>{ item.shortcode_name }</option>
            });

        }

        BlockServerRenderScript();

        return <div className='gscoach-coachs--block'>

            <div className='gscoach-coachs--toolbar'>

                <label>{ gs_coach_block.select_shortcode }</label>

                <select onChange={updateShortcodeID} value={shortcodeID}>
                    { getShortcodeOptions() }
                </select>

                <p className='gs-coach-block--des'>

                    <span>
                        { gs_coach_block.edit_description_text }
                        <a href={gs_coach_block.edit_link + shortcodeID} target='_blank'>{ gs_coach_block.edit_link_text }</a>
                    </span>

                    <span>
                        { gs_coach_block.create_description_text }
                        <a href={gs_coach_block.create_link} target='_blank'>{ gs_coach_block.create_link_text }</a>
                    </span>

                </p>

            </div>

            <ServerSideRender className={className} block='gscoach/shortcodes' attributes={ attributes } />

        </div>
    }

    const Icon = function() {
        return <svg width="81" height="80" viewBox="0 0 81 80" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="40.7334" cy="40" r="40" fill="url(#paint0_linear_25_144)"/><path fill-rule="evenodd" clip-rule="evenodd" d="M40.7267 22.3999C36.2289 22.3999 32.5517 26.1225 32.5517 30.6606C32.5517 35.1986 36.2289 38.9088 40.7267 38.9088C45.2245 38.9088 48.914 35.1986 48.914 30.6606C48.914 26.1225 45.2245 22.3999 40.7267 22.3999ZM26.6491 31.308C25.3475 31.308 24.1003 31.8292 23.179 32.7574C22.259 33.6857 21.7424 34.9453 21.7424 36.2586C21.7424 37.5719 22.259 38.8302 23.179 39.7598C24.099 40.688 25.3475 41.2092 26.6491 41.2092C27.9507 41.2092 29.1978 40.688 30.1192 39.7598C31.0392 38.8316 31.5558 37.5719 31.5558 36.2586C31.5558 34.9453 31.0392 33.687 30.1192 32.7574C29.1978 31.8292 27.9507 31.308 26.6491 31.308ZM54.818 31.308C53.5163 31.308 52.2692 31.8292 51.3479 32.7574C50.4279 33.6857 49.9113 34.9453 49.9113 36.2586C49.9113 37.5719 50.4279 38.8302 51.3479 39.7598C52.2679 40.688 53.5163 41.2092 54.818 41.2092C56.1196 41.2092 57.3667 40.688 58.2881 39.7598C59.2081 38.8316 59.7246 37.5719 59.7246 36.2586C59.7246 34.9453 59.2081 33.687 58.2881 32.7574C57.3667 31.8292 56.1196 31.308 54.818 31.308ZM40.7267 40.559C37.183 40.559 33.6298 41.4268 30.8275 43.3107C28.0253 45.1961 26.0108 48.2559 26.0108 52.1063C26.0108 54.8209 28.2338 57.0638 30.9243 57.0638H50.5441C53.2346 57.0638 55.4576 54.8209 55.4576 52.1063C55.4576 48.2559 53.4418 45.1961 50.6409 43.3107C47.8373 41.4268 44.2704 40.559 40.7267 40.559ZM24.422 43.0561C22.9391 43.2775 21.3185 43.7038 19.7838 44.478C17.4273 45.6662 15.2002 47.9008 15.2002 51.1105C15.2002 53.825 17.4164 56.0611 20.1069 56.0611H23.4543C22.398 54.6694 21.7383 52.9614 21.7383 51.1077C21.7397 48.059 22.796 45.288 24.422 43.0561ZM57.0505 43.0616C58.6738 45.2921 59.7301 48.0617 59.7301 51.1063C59.7301 52.9628 59.0704 54.6735 58.0114 56.0666H61.3602C64.0507 56.0666 66.2669 53.8305 66.2669 51.116C66.2669 47.9063 64.0398 45.6717 61.6832 44.4835C60.1499 43.7107 58.532 43.283 57.0505 43.0616Z" fill="white"/><defs><linearGradient id="paint0_linear_25_144" x1="5.62229" y1="82.6667" x2="74.5112" y2="12.4444" gradientUnits="userSpaceOnUse"><stop stop-color="#680BEC"/><stop offset="1" stop-color="#B71CEA"/></linearGradient></defs></svg>
    }

    registerBlockType('gscoach/shortcodes', {

        title: __( 'GS Coaches', 'gscoach' ),
        description: __( 'Show Coaches by GS Coach Plugin', 'gscoach' ),
        icon: Icon,
        category: 'layout',
        keywords: [ 'image', 'photo', 'pics' ],
        example: { attributes: {} },
        supports: {
            align: ['wide', 'full']
        },
        attributes: {
            shortcode: {
                type: 'string',
                default: gs_coach_block.gs_coach_shortcodes[0] ? gs_coach_block.gs_coach_shortcodes[0].id : ''
            },
            align: {
                type: 'string',
                default: 'wide'
            }
        },
        edit: withSelect( () => {} )( BlockDisplay )

    });

    registerBlockType('gscoach/single-team-block', {
        title: __( 'GS Single Coach coach', 'gscoach' ),
        description: __( 'Show Single Coach coach by GS Coach Plugin', 'gscoach' ),
        icon: Icon,
        category: 'layout',
        edit: () => {
            return (
                <div className='gs-coach-single--block'>
                    <ServerSideRender
                        block="gscoach/single-team-block"
                    />
                </div>
            );
        },
        save() {
            return null; // Nothing to save here..
        }
    });

}( window.wp, window.React, jQuery ));