# SkillLink Figma prototype specification

The repository cannot publish a real Figma file without a Figma workspace or an access token. This document defines the prototype that should be created in Figma, using the implemented Blade routes as the source of truth.

## Desktop frames

- Landing: `/`
- Login: `/login`
- Registration: `/register`
- Client dashboard: `/client/dashboard`
- Create mission: `/missions/create`
- Client missions: `/missions`
- Mission details: `/missions/{mission}`
- Client applications: `/client/applications`
- Freelancer dashboard: `/freelance/dashboard`
- Available missions: `/freelance/missions`
- Freelancer mission details: `/freelance/missions/{mission}`
- My offers: `/freelance/applications`
- Admin dashboard: `/admin/dashboard`

## Mobile frames

Create responsive variants for login, registration, dashboard, mission list, mission details, offer form, and profile. Navigation should collapse to the existing mobile menu behavior.

## Prototype flows

1. Landing -> Login -> role-based Dashboard.
2. Client Dashboard -> Create Mission -> My Missions -> Applications.
3. Freelancer Dashboard -> Available Missions -> Mission Details -> Submit Offer.
4. Client Applications -> Accept Offer -> Mission In Progress.
5. Freelancer My Offers -> Complete Mission -> Review Client.
6. Admin Dashboard -> Users, Missions, Categories.

## Design constraints

Keep the current Laravel Blade/Tailwind implementation as the implementation source of truth. Use the MCD entities `USER`, `OFFER`, `MISSION`, `CATEGORY`, `REVIEW`, and `NOTIFICATION` in the data annotations and do not invent dashboard values or screens disconnected from routes.
