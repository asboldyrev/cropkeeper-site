import '../css/analytics-consent.css';
import '../css/tariffs.css';

import {
    ArrowRight,
    ArrowUpRight,
    BookOpenText,
    CalendarDays,
    Carrot,
    Check,
    Circle,
    CircleCheck,
    CloudSun,
    FileText,
    Leaf,
    ListChecks,
    NotebookPen,
    PackageOpen,
    ShieldCheck,
    Sprout,
    UserRoundCheck,
    createIcons,
} from 'lucide';

createIcons({
    icons: {
        ArrowRight,
        ArrowUpRight,
        BookOpenText,
        CalendarDays,
        Carrot,
        Check,
        Circle,
        CircleCheck,
        CloudSun,
        FileText,
        Leaf,
        ListChecks,
        NotebookPen,
        PackageOpen,
        ShieldCheck,
        Sprout,
        UserRoundCheck,
    },
});

const header = document.querySelector('[data-header]');

if (header) {
    const syncHeader = () => {
        header.classList.toggle('is-scrolled', window.scrollY > 12);
    };

    syncHeader();
    window.addEventListener('scroll', syncHeader, { passive: true });
}

const analyticsConsent = document.querySelector('[data-analytics-consent]');

if (analyticsConsent) {
    const storageKey = 'cropkeeper.analytics-consent';
    const consentVersion = analyticsConsent.dataset.consentVersion;
    const counterId = Number.parseInt(analyticsConsent.dataset.metrikaId ?? '', 10);
    const acceptButton = analyticsConsent.querySelector('[data-analytics-accept]');
    const rejectButton = analyticsConsent.querySelector('[data-analytics-reject]');
    const settingsButtons = [...document.querySelectorAll('[data-analytics-settings]')];

    const readConsent = () => {
        try {
            const rawValue = window.localStorage.getItem(storageKey);
            if (!rawValue) {
                return null;
            }

            const value = JSON.parse(rawValue);
            if (value?.version !== consentVersion || !['accepted', 'rejected'].includes(value?.status)) {
                return null;
            }

            return value.status;
        } catch {
            return null;
        }
    };

    const saveConsent = (status) => {
        try {
            window.localStorage.setItem(storageKey, JSON.stringify({
                status,
                version: consentVersion,
            }));
        } catch {
            // If localStorage is unavailable, the choice applies only to the current page.
        }
    };

    const showConsent = () => {
        analyticsConsent.hidden = false;
        requestAnimationFrame(() => analyticsConsent.classList.add('is-visible'));
    };

    const hideConsent = () => {
        analyticsConsent.classList.remove('is-visible');
        window.setTimeout(() => {
            analyticsConsent.hidden = true;
        }, 160);
    };

    const removeMetrikaCookies = () => {
        const names = ['_ym_uid', '_ym_d', '_ym_isad', '_ym_visorc'];
        names.forEach((name) => {
            document.cookie = `${name}=; Max-Age=0; path=/; SameSite=Lax`;
        });
    };

    const stopMetrika = () => {
        if (Number.isInteger(counterId) && typeof window.ym === 'function') {
            window.ym(counterId, 'destruct');
        }

        document.querySelectorAll('script[data-yandex-metrika]').forEach((script) => script.remove());
        removeMetrikaCookies();
    };

    const startMetrika = () => {
        if (!Number.isInteger(counterId) || counterId <= 0 || document.querySelector('script[data-yandex-metrika]')) {
            return;
        }

        window.ym = window.ym || function () {
            (window.ym.a = window.ym.a || []).push(arguments);
        };
        window.ym.l = Date.now();

        const script = document.createElement('script');
        script.async = true;
        script.src = 'https://mc.yandex.ru/metrika/tag.js';
        script.dataset.yandexMetrika = 'true';
        document.head.appendChild(script);

        window.ym(counterId, 'init', {
            defer: true,
            clickmap: analyticsConsent.dataset.metrikaClickmap === 'true',
            trackLinks: analyticsConsent.dataset.metrikaTrackLinks === 'true',
            accurateTrackBounce: analyticsConsent.dataset.metrikaAccurateBounce === 'true',
            webvisor: analyticsConsent.dataset.metrikaWebvisor === 'true',
        });

        window.ym(counterId, 'hit', `${window.location.origin}${window.location.pathname}`, {
            title: document.title,
        });
    };

    const applyConsent = (status) => {
        saveConsent(status);

        if (status === 'accepted') {
            startMetrika();
        } else {
            stopMetrika();
        }

        hideConsent();
    };

    acceptButton?.addEventListener('click', () => applyConsent('accepted'));
    rejectButton?.addEventListener('click', () => applyConsent('rejected'));
    settingsButtons.forEach((button) => button.addEventListener('click', showConsent));

    const currentConsent = readConsent();
    if (currentConsent === 'accepted') {
        startMetrika();
    } else if (currentConsent !== 'rejected') {
        showConsent();
    }
}
