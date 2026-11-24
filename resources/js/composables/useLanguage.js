import { ref, computed } from 'vue';

const currentLang = ref(
    typeof window !== 'undefined' && window.localStorage
        ? window.localStorage.getItem('wedding_lang') || 'en'
        : 'en'
);

export const translations = {
    nav: {
        home: { en: 'Home', si: 'මුල් පිටුව' },
        events: { en: 'Events', si: 'උත්සව' },
        venue: { en: 'Venue', si: 'ස්ථානය' },
        rsvp: { en: 'RSVP', si: 'RSVP' },
    },
    door: {
        holyMatrimony: { en: 'Holy Matrimony', si: 'ශුද්ධ වූ විවාහ මංගල්‍යය' },
        theWeddingOf: { en: 'The Wedding Of', si: 'මංගල ආරාධනය' },
        groomName: { en: 'Buddhima', si: 'බුද්ධිම' },
        brideName: { en: 'Shavindi', si: 'ශාවින්දි' },
        dateText: { en: 'Tuesday, 29th December 2026', si: '2026 දෙසැම්බර් 29 අඟහරුවාදා' },
        cordiallyInviting: { en: 'Cordially Inviting', si: 'සාදරයෙන් ඇරයුම් කරමු' },
        openDoors: { en: 'Push to Open Doors', si: 'ආරාධනා පත්‍රය විවෘත කරන්න' },
        skip: { en: 'Skip', si: 'ඉදිරියට' },
        enter: { en: 'Enter', si: 'ඇතුල් වන්න' },
        knock: { en: 'Knock', si: 'තට්ටු කරන්න' },
    },
    header: {
        holyMatrimony: { en: 'The Holy Matrimony', si: 'ශුද්ධ වූ විවාහ මංගල්‍යය' },
        subtitle: { en: 'Celebrating Love & Faith Before God', si: 'දෙවියන් වහන්සේ ඉදිරියේ ප්‍රේමය සහ විශ්වාසය එක්තැන් කරමින්' },
        groomName: { en: 'Buddhima', si: 'බුද්ධිම' },
        brideName: { en: 'Shavindi', si: 'ශාවින්දි' },
        cordiallyInviting: { en: 'CORDIALLY INVITING', si: 'සාදරයෙන් ඇරයුම් කරමු' },
        requestBlessings: { en: 'Request the honour of your presence and blessings', si: 'ඔබ සැමගේ ආශීර්වාදය සහ සහභාගීත්වය ගෞරවයෙන් අපේක්ෂා කරමු' },
        sonOf: { en: 'SON OF', si: 'පුත්' },
        daughterOf: { en: 'DAUGHTER OF', si: 'දියණිය' },
        groomParents: { en: 'Mr. Sumith Rodrigo & Mrs. Banduwathi', si: 'සුමිත් රුද්‍රිගු මහතා සහ බන්දුලතා මහත්මිය' },
        brideParents: { en: 'Mr. Lalith Fernando & Mrs. Priska Pieris', si: 'ලලිත් ප්‍රනාන්දු මහතා සහ ප්‍රිස්කා පීරිස් මහත්මිය' },
        month: { en: 'DECEMBER', si: 'දෙසැම්බර්' },
        year: { en: '2026', si: '2026' },
        day: { en: '29', si: '29' },
        time: { en: 'TUESDAY · 4:00 PM', si: 'අඟහරුවාදා · පස්වරු 4:00' },
        scriptureVerse: {
            en: '“And now these three remain: faith, hope and love. But the greatest of these is love.”',
            si: '“දැන් ඇදහිල්ල, බලාපොරොත්තුව හා ප්‍රේමය යන මේ තුන පවතී; මින් උතුම්ම ධර්මය ප්‍රේමයයි.”'
        },
        scriptureCitation: { en: '1 CORINTHIANS 13:13', si: '1 කොරින්ති 13:13' },
        scrollToExplore: { en: 'SCROLL TO EXPLORE', si: 'තවදුරටත් පහළට බලන්න' },
    },
    countdown: {
        theBigDay: { en: 'THE BIG DAY AWAITS', si: 'මංගල දිනය උදාවන තෙක්' },
        days: { en: 'Days', si: 'දින' },
        hours: { en: 'Hours', si: 'පැය' },
        minutes: { en: 'Minutes', si: 'මිනිත්තු' },
        seconds: { en: 'Seconds', si: 'තත්පර' },
        untilWeSay: { en: 'Until We Say "I Do" Before God', si: 'අප දෙවියන් වහන්සේ ඉදිරියේ එක්වන ඒ සුබ මොහොත දක්වා' },
    },
    events: {
        celebrateWithUs: { en: 'Celebrate With Us', si: 'අප හා එක්වන්න' },
        weddingEvents: { en: 'Wedding Events', si: 'විවාහ මංගල උත්සව' },
        weddingMass: { en: 'THE WEDDING MASS', si: 'ශුද්ධ වූ මංගල දිව්‍ය පූජාව' },
        massDate: { en: '29th December 2026', si: '2026 දෙසැම්බර් 29' },
        massTime: { en: '4:00 PM', si: 'පස්වරු 4:00' },
        massVenue: { en: "St. Sebastian's Church, Moratuwa", si: 'මොරටුව ශාන්ත සෙබස්තියන් දේවස්ථානය' },
        reception: { en: 'THE RECEPTION', si: 'මංගල සාදය' },
        receptionDate: { en: '29th December 2026', si: '2026 දෙසැම්බර් 29' },
        receptionTime: { en: '6:30 PM to 12:00 AM', si: 'පස්වරු 6:30 සිට රාත්‍රී 12:00 දක්වා' },
        receptionVenue: { en: 'Vinrich Lake Resort, Piliyandala', si: 'පිළියන්දල වින්රිච් ලේක් රිසෝට්' },
    },
    venue: {
        theSetting: { en: 'The Setting', si: 'ස්ථානයන්' },
        weddingVenue: { en: 'Wedding Venue', si: 'මංගල උත්සව ස්ථාන' },
        ceremonyReception: { en: 'Ceremony & Reception', si: 'දිව්‍ය පූජාව සහ මංගල සාදය' },
        venueName: { en: "St. Sebastian's Church & Vinrich Lake Resort", si: 'ශාන්ත සෙබස්තියන් දේවස්ථානය සහ වින්රිච් ලේක් රිසෝට්' },
        venueAddress: { en: 'Moratuwa & Piliyandala, Sri Lanka', si: 'මොරටුව සහ පිළියන්දල, ශ්‍රී ලංකාව' },
        description: {
            en: "We warmly welcome you to St. Sebastian's Church in Moratuwa for the Wedding Mass at 4:00 PM, followed by the Wedding Reception at Vinrich Lake Resort, Piliyandala from 6:30 PM to 12:00 AM.",
            si: "2026 දෙසැම්බර් 29 දින පස්වරු 4:00 ට මොරටුව ශාන්ත සෙබස්තියන් දේවස්ථානයේදී පැවැත්වෙන ශුද්ධ වූ මංගල දිව්‍ය පූජාවටත්, ඉන් අනතුරුව පස්වරු 6:30 සිට පිළියන්දල වින්රිච් ලේක් රිසෝට් හිදී පැවැත්වෙන මංගල සාදයටත් ඔබ සැමට සාදරයෙන් ආරාධනා කරමු."
        },
        getDirections: { en: 'Get Driving Directions ↗', si: 'මාර්ග උපදෙස් ලබාගන්න ↗' },
        openInMaps: { en: 'Open in Maps', si: 'සිතියම බලන්න' },
        interactiveNav: { en: 'Interactive Navigation', si: 'සිතියම් මාර්ගෝපදේශය' },
    },
    rsvp: {
        kindlyReply: { en: 'Kindly Reply', si: 'ඔබගේ පැමිණීම දන්වන්න' },
        willYouJoin: { en: 'Will You Join Us?', si: 'ඔබ අප හා එක්වන්නේද?' },
        subtitle: { en: 'We joyfully await your presence. Please let us know if you will be celebrating with us.', si: 'ඔබගේ පැමිණීම අපි ඉමහත් සතුටින් අපේක්ෂා කරමු. ඔබගේ සහභාගීත්වය කාරුණිකව දන්වන්න.' },
        respondBy: { en: 'Kindly respond by 1st December 2026', si: 'කරුණාකර 2026 දෙසැම්බර් 1 දිනට පෙර දන්වන්න' },
        reservedFor: { en: 'Invitation Reserved For', si: 'ආරාධනය වෙන් කර ඇත' },
        reservedForCount: { en: (n) => `Reserved for up to ${n} ${n > 1 ? 'guests' : 'guest'}`, si: (n) => `අමුත්තන් ${n} දෙනෙකු සඳහා ආරාධිතයි` },
        willYouAttend: { en: 'Will you be attending?', si: 'ඔබ සහභාගී වන්නේද?' },
        joyfullyAccept: { en: 'Joyfully Accept', si: 'සතුටින් සහභාගී වෙමි' },
        regretfullyDecline: { en: 'Regretfully Decline', si: 'සහභාගී විය නොහැක' },
        sendRsvp: { en: 'Send RSVP', si: 'RSVP තහවුරු කරන්න' },
        recording: { en: 'Recording RSVP...', si: 'තහවුරු කරමින්...' },
        confirmedAttending: { en: 'Response Confirmed: Joyfully Accepting', si: 'තහවුරු කරන ලදී: සතුටින් සහභාගී වෙමි' },
        confirmedDeclined: { en: 'Response Confirmed: Regretfully Declining', si: 'තහවුරු කරන ලදී: සහභාගී විය නොහැක' },
        attendingMessage: { en: "We are truly honored that you will be joining us. We look forward to celebrating together in God's grace!", si: 'ඔබ අප හා එක්වීම අපට ඉමහත් ගෞරවයකි. දෙවියන් වහන්සේගේ ආශීර්වාදය මැද ඔබ සමඟ සමරන්නට බලාපොරොත්තු වෙමු!' },
        declinedMessage: { en: 'We regret you cannot be with us in person, but your warm prayers and blessings will remain in our hearts.', si: 'ඔබට අප හා එක්වීමට නොහැකි වීම පිළිබඳ කනගාටු වන අතර, ඔබගේ ආශීර්වාදය සහ ප්‍රාර්ථනා අප හදවත් තුළ සදා රැඳෙනු ඇත.' },
        changeResponse: { en: 'Change RSVP response', si: 'පිළිතුර වෙනස් කරන්න' },
    },
    footer: {
        saveTheDate: { en: 'SAVE THE DATE', si: 'මංගල දිනය' },
        thankYou: { en: 'Thank you for being part of our special day.', si: 'අපගේ විශේෂ දිනයේ කොටස්කරුවෙකු වීම පිළිබඳ ඔබට ස්තූතියි.' },
        withBlessings: { en: 'With blessings and gratitude', si: 'ආශීර්වාදය සහ ගෞරවය සමඟින්' },
    },
    scroll: {
        scroll: { en: 'Scroll', si: 'පහළට' },
    }
};

export function useLanguage() {
    const isSinhala = computed(() => currentLang.value === 'si');

    const toggleLanguage = () => {
        setLanguage(currentLang.value === 'en' ? 'si' : 'en');
    };

    const setLanguage = (lang) => {
        currentLang.value = lang;
        if (typeof window !== 'undefined' && window.localStorage) {
            window.localStorage.setItem('wedding_lang', lang);
        }
    };

    const t = (section, key, ...args) => {
        const sec = translations[section];
        if (!sec || !sec[key]) return key;
        const entry = sec[key];
        const val = entry[currentLang.value] || entry.en;
        if (typeof val === 'function') {
            return val(...args);
        }
        return val;
    };

    return {
        currentLang,
        isSinhala,
        toggleLanguage,
        setLanguage,
        t,
        translations,
    };
}
