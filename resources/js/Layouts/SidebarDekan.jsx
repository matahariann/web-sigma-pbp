import React from "react";
import { Icon } from "@iconify/react";
import { MdOutlineDashboard } from "react-icons/md";
import { SiGoogleclassroom } from "react-icons/si";
import { CgProfile } from "react-icons/cg";
import { RiCalendarScheduleLine } from "react-icons/ri";
import { FaChalkboardTeacher } from "react-icons/fa";
import { IoIosLogOut } from "react-icons/io";

const SidebarDekan = ({ dosen }) => {
    return (
        <aside
            id="default-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 border-5 border-blue-500"
            aria-label="Sidebar"
        >
            <div className="container mx-auto py-[13px] bg-[#1EAADF]">
                <div className="flex justify-center items-center    ">
                    <a href="dashboard">
                        <img
                            src="/logoundip.png"
                            style={{ width: "35px", height: "25px" }}
                        />
                    </a>
                    <a
                        href="dashboard"
                        className="font-serif font-semibold text-xl text-white"
                    >
                        SIGMA UNDIP
                    </a>
                </div>
            </div>
            <div className="border-3 border-blue-500"></div>
            <div
                class="h-full px-3 py-4 overflow-y-auto bg-gray-50"
                style={{ backgroundColor: "#1EAADF" }}
            >
                <ul class="space-y-2 font-medium">
                    <li>
                        <CgProfile
                            className="mx-auto text-white"
                            style={{ fontSize: "150px" }}
                        />
                        {/* <Icon
                            icon="gg:profile"
                            color="white"
                            width="150"
                            height="150"
                            className="mx-auto mt-4"
                        /> */}
                        <div className="flex flex-col p-2 mb-3">
                            <span className="dark:text-white text-xl">
                                {dosen.nama}
                            </span>
                            <span className="dark:text-slate-300 text-l">
                                {dosen.nip}
                            </span>
                            <span className="dark:text-slate-300 text-m">
                                {dosen.nama_fakultas}
                            </span>
                        </div>
                    </li>
                    <li>
                        <a
                            href="/dekan/dashboard"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-white group"
                        >
                            {/* <Icon
                                icon="ic:baseline-pie-chart"
                                width="24"
                                height="24"
                            /> */}
                            <MdOutlineDashboard style={{ fontSize: "24px" }} />
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="/dekan/setujui-ruang"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-white group"
                        >
                            {/* <Icon
                                icon="streamline:group-meeting-call-solid"
                                width="24"
                                height="24"
                            /> */}
                            <SiGoogleclassroom style={{ fontSize: "24px" }} />
                            <span class="ms-3">Persetujuan Ruang</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="/dekan/setujui-jadwal"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-white group"
                        >
                            {/* <Icon icon="ion:calendar" width="24" height="24" /> */}
                            <RiCalendarScheduleLine
                                style={{ fontSize: "24px" }}
                            />
                            <span class="ms-3">Persetujuan Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="/"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-white group"
                        >
                            {/* <Icon icon="mdi:lecture" width="24" height="24" /> */}
                            <FaChalkboardTeacher style={{ fontSize: "24px" }}/>
                            <span class="ms-3">Dosen Page</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="/actionlogout"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-white group"
                        >
                            {/* <Icon
                                icon="ri:logout-box-r-fill"
                                width="24"
                                height="24"
                            /> */}
                            <IoIosLogOut style={{ fontSize: "24px" }}/>
                            <span class="flex-1 ms-3 whitespace-nowrap">
                                Logout
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    );
};

export default SidebarDekan;
