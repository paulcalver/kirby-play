  </main>

  <script>
    (function () {
      // Fade in on first paint
      window.addEventListener('DOMContentLoaded', function () {
        document.documentElement.classList.remove('preload');
      });

      // Helper: same-origin?
      function isInternalLink(a) {
        try {
          const url = new URL(a.href, window.location.href);
          return url.origin === window.location.origin && !a.hasAttribute('target');
        } catch (e) {
          return false;
        }
      }

      // Intercept clicks on internal links
      document.addEventListener('click', function (e) {
        // Only left-clicks, no modifiers
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

        const a = e.target.closest('a[href]');
        if (!a || !isInternalLink(a)) return;

        // Allow hash-only links to jump without transition
        const href = a.getAttribute('href');
        if (href && href.startsWith('#')) return;

        e.preventDefault();

        // Trigger fade-out, then navigate when the transition ends
        const body = document.body;
        const go = () => window.location.href = a.href;

        // If the body has a transition, wait for it; otherwise go immediately
        let navigated = false;
        const onEnd = () => {
          if (!navigated) {
            navigated = true;
            body.removeEventListener('transitionend', onEnd);
            go();
          }
        };

        body.addEventListener('transitionend', onEnd, { once: true });
        // Safety timeout in case transitionend doesn't fire
        setTimeout(onEnd, 400);

        body.classList.add('page-fade-out');
      }, false);

      // Handle back/forward cache: ensure we fade in again
      window.addEventListener('pageshow', function (e) {
        if (e.persisted) {
          document.body.classList.remove('page-fade-out');
          document.documentElement.classList.remove('preload');
        }
      });
    })();
  </script>


</body>
</html>
