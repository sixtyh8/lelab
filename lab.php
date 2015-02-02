<?php
$metaTITLE['fr'] = 'LAB';
$metaTITLE['en'] = 'LAB';
$bodyClass = 'lab';

include 'includes/header.php';
?>
<div id="twitter-feed">
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 10,
  interval: 6000,
  width: 'auto',
  height: 450,
  theme: {
    shell: {
      background: '#1a1a1a',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#426ac7'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: 'all'
  }
}).render().setUser('LeLabMastering').start();
</script>
</div>
<?php
include 'includes/footer.php';
?>