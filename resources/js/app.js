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
    Info,
    Leaf,
    ListChecks,
    Map,
    NotebookPen,
    PackageOpen,
    ShieldCheck,
    Sprout,
    TriangleAlert,
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
        Info,
        Leaf,
        ListChecks,
        Map,
        NotebookPen,
        PackageOpen,
        ShieldCheck,
        Sprout,
        TriangleAlert,
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

const billingSwitch = document.querySelector('[data-billing-switch]');

if (billingSwitch) {
    const buttons = [...billingSwitch.querySelectorAll('[data-period]')];
    const priceNodes = [...document.querySelectorAll('[data-plan-price]')];

    const renderPeriod = (period) => {
        buttons.forEach((button) => {
            const isActive = button.dataset.period === period;
            button.classList.toggle('is-active', isActive);
            button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        priceNodes.forEach((node) => {
            const isFree = node.dataset.free === 'true';
            const value = node.dataset[period]?.trim();
            const periodNode = node.parentElement?.querySelector('[data-plan-period]');

            if (isFree) {
                node.textContent = '0 ₽';
                node.dataset.empty = 'false';
                if (periodNode) {
                    periodNode.textContent = 'без ограничения по времени';
                }
                return;
            }

            if (value) {
                node.textContent = value;
                node.dataset.empty = 'false';
                if (periodNode) {
                    periodNode.textContent = period === 'monthly' ? 'в месяц' : 'в год';
                }
                return;
            }

            node.textContent = 'Цена настраивается';
            node.dataset.empty = 'true';
            if (periodNode) {
                periodNode.textContent = 'будет указана до запуска оплат';
            }
        });
    };

    buttons.forEach((button) => {
        button.addEventListener('click', () => renderPeriod(button.dataset.period));
    });

    renderPeriod('monthly');
}
