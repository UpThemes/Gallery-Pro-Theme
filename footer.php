            </div><!-- #main -->    
            <?php gpro_abovefooter(); ?>    
            <div id="footer">
                <?php get_sidebar('subsidiary'); ?>
                <div id="siteinfo">        
                    <?php /* footer text set in theme options */ echo do_shortcode(__(stripslashes(gpro_footertext(null)), 'gpro')); ?>
                    </div><!-- #siteinfo -->
            </div><!-- #footer -->
            <?php gpro_belowfooter(); ?>  
        </div><!-- #wrapper .hfeed -->
        <?php wp_footer(); ?>
        <?php gpro_after(); ?>
    </div>
</body>
</html>