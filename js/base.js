document.addEventListener('DOMContentLoaded', function() {

    var $win = window,
        $doc = document,
        $docbody = $doc.body,
        $plaids = document.querySelectorAll('.plaid'),
        $searchbtn = document.querySelectorAll('.searchbtn'),
        $searchoverlayclose = document.getElementById('searchoverlayclose'),
        winW = $win.innerWidth,
        winH = $win.innerHeight,
        lastScrollTop,
        st;

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    function throttle(fn, wait) {
        var time = Date.now();
        return function() {
            if ((time + wait - Date.now()) < 0) {
                fn();
                time = Date.now();
            }
        }
    }

    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();

    function upOrDown() {
        st = $win.pageYOffset;
        if (st > lastScrollTop && st > 90) {
            $docbody.classList.add('scrD');
            $docbody.classList.remove('scrU');
        }
        if (st < lastScrollTop && st > 90) {
            $docbody.classList.add('scrU');
            $docbody.classList.remove('scrD');
        }
        if (st <= 90) {
            $docbody.classList.remove('scrD');
            $docbody.classList.remove('scrU');
        }
        lastScrollTop = st;
    }

    function resizer() {
        winW = $win.innerWidth,
            winH = $win.innerHeight;
        $docbody.classList.remove('show-menu');
        $docbody.classList.remove('show-search');
    }

    function togglemen() {
        if ($docbody.classList.contains('show-menu')) {
            $docbody.classList.remove('show-menu');
        } else {
            $docbody.classList.add('show-menu');
        }
    }

    function togglesearch() {
        if ($docbody.classList.contains('show-search')) {
            $docbody.classList.remove('show-search');
        } else {
            $docbody.classList.add('show-search');
        }
    }


    let testReq = new Request(
        "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {
            method: "HEAD",
            mode: "no-cors"
        }
    );

    fetch(testReq).then(response => {}).catch(error => {
        console.log("ADBLOCK DETECTED");
        $plaids.forEach(function(plaid) {
            plaid.remove();
        });
    });

    try {
        document.getElementById('menbtn').addEventListener('click', togglemen);
    } catch (error) {
        console.log('ERROR');
    }

    $searchbtn.forEach(function(searchbtn) {
        searchbtn.addEventListener('click', togglesearch);
    });

    $searchoverlayclose.addEventListener('click', togglesearch);

    $win.addEventListener('scroll', debounce(upOrDown, 100));
    //$win.addEventListener('resize', debounce(resizer, 250));

    //resizer();

});

const eventListenerOptionsSupported = () => {
    let supported = false;

    try {
        const opts = Object.defineProperty({}, 'passive', {
            get() {
                supported = true;
            }
        });

        window.addEventListener('test', null, opts);
        window.removeEventListener('test', null, opts);
    } catch (e) {}

    return supported;
}

const defaultOptions = {
    passive: false,
    capture: false
};
const supportedPassiveTypes = [
    'scroll', 'wheel',
    'touchstart', 'touchmove', 'touchenter', 'touchend', 'touchleave',
    'mouseout', 'mouseleave', 'mouseup', 'mousedown', 'mousemove', 'mouseenter', 'mousewheel', 'mouseover'
];
const getDefaultPassiveOption = (passive, eventName) => {
    if (passive !== undefined) return passive;

    return supportedPassiveTypes.indexOf(eventName) === -1 ? false : defaultOptions.passive;
};

const getWritableOptions = (options) => {
    const passiveDescriptor = Object.getOwnPropertyDescriptor(options, 'passive');

    return passiveDescriptor && passiveDescriptor.writable !== true && passiveDescriptor.set === undefined ?
        Object.assign({}, options) :
        options;
};

const overwriteAddEvent = (superMethod) => {
    EventTarget.prototype.addEventListener = function(type, listener, options) {
        const usesListenerOptions = typeof options === 'object' && options !== null;
        const useCapture = usesListenerOptions ? options.capture : options;

        options = usesListenerOptions ? getWritableOptions(options) : {};
        options.passive = getDefaultPassiveOption(options.passive, type);
        options.capture = useCapture === undefined ? defaultOptions.capture : useCapture;

        superMethod.call(this, type, listener, options);
    };

    EventTarget.prototype.addEventListener._original = superMethod;
};

const supportsPassive = eventListenerOptionsSupported();

if (supportsPassive) {
    const addEvent = EventTarget.prototype.addEventListener;
    overwriteAddEvent(addEvent);
}